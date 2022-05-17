<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasswordController extends AbstractController
{
    #[Route('/account/changePassword', name: 'app_change_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHashes,EntityManagerInterface $manager): Response
    {$notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('old_password')->getData();
            dump($oldPassword);
            if ($passwordHashes->isPasswordValid($user, $oldPassword)) {
                $new_psw = $form->get('new_password')->getData();
                dump($new_psw);
                $password = $passwordHashes->hashPassword($user, $new_psw);
                dump($password);
                $user->setPassword($password);

                // enregistrement en bdd
                $manager->flush();

                $notification = ' Votre mot de passe a bien ete mis a jour';
            } else {
                $notification = ' Votre mot de passe actuelle n\'est pas le bon';
            }
        }
        return $this->render('account/changePassword.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }

}
