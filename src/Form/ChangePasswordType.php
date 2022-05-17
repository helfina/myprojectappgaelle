<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'disabled' => true,
                'label' => ' Mon addresse Email'
            ])

            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Mon prenom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'Mon nom'
            ])

            ->add('old_password', PasswordType::class,[
                'label' => 'Mon mot de passe actuel',
                'mapped'            => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir le mot de pass actuel'
                ]
            ])

            ->add('new_password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'mapped'            => false,
                'invalid_message'   => 'le mot de pass et la confirmation doivent etre identique',
                'required'          => true,
                'label'             => 'Mon nouveau Mot de Pass',
                'first_options'     => [
                    'label' => 'mot de Pass',
                    'attr'  => [
                        'placeholder' => 'Merci de saisir votre mot de pass'
                    ]
                ],

                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de Pass',
                    'attr'  => [
                        'placeholder' => 'Merci de confirmez votre nouveau mot de pass'
                    ]
                ],

                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de pass'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Mettre a jour"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
