<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHashes): Response
    {

        $user = new User(); // j'instancie ma class user
        $form = $this->createForm(RegisterType::class, $user); // je cree le formulaire
        /*
         * 1 - des que ce formulaire est soumis
         * 2 - Je veux que tu traites l'information
         * 3 - Regade si tout vas bien (formulaire valide ?)
         * 4 - on est bon, on enregistre en bdd
         */

        // listen the request
        $form->handleRequest($request);
        // est-ce que mon formulaire a ete soumis et est ce que mon formulaire est valide
        if($form->isSubmitted() && $form->isValid()){
            // tu inject dans l'objet user toutes le données que tu récupères dans le formulaire
            $user = $form->getData();
            dump($user);

            // hash du mdp
            $password = $passwordHashes->hashPassword($user,$user->getPassword());
            $user->setPassword($password);
            dump($password);

            // enregistrement en bdd
            $this->entityManager->persist($user); // je prepare et je fige la donner pour la creation de l'entity
            $this->entityManager->flush();
        }


        return $this->render('register/index.html.twig',[
            'form' => $form->createView() // je cree la vu du formulaire
        ]);
    }

}
