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
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre Prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Votre Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'constraints' => new Length([
                    'min' => 4,
                    'max' => 60
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre Email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'invalid_message'   => 'le mot de pass et la confirmation doivent etre identique',
                'required'          => true,
                'label'             => 'Votre Mot de Pass',
                'first_options'     => [
                    'label' => 'votre  mot de Pass',
                    'attr'  => [
                        'placeholder' => 'Merci de saisir votre  nouveaux mot de pass'
                    ]
                ],

                'second_options' => [
                    'label' => 'Confirmez votre  mot de Pass',
                    'attr'  => [
                        'placeholder' => 'Merci de confirmez votre mot de pass'
                    ]
                ],

                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de pass'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
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
