<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beginAt', DateTimeType::class,[
                'label' =>'debut',
                'attr' =>[
                    'class' => 'form-control'
                ]

            ])
            ->add('endAt',DateTimeType::class,[
                'label' =>'fin',
                'attr' =>[
                    'class' => 'form-control'
                ]
            ])
            ->add('title', TextType::class,[
                'label' =>'titre',
                'attr' =>[
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
