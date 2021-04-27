<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'constraints' =>  new Length([
                'min' => 2,
                'max' => 30,
            ]),
            'attr' => [
                'placeholder' => 'Prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'constraints' =>  new Length([
                'min' => 2,
                'max' => 30,
            ]),
            'attr' => [
                'placeholder' => 'Nom'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => [
                'placeholder' => 'Email'
            ]
        ])

        ->add('content', TextareaType::class, [
            'label' => "Message",
            'attr' => [
                'placeholder' => 'Nom'
            ]

        ])

        ->add('submit', SubmitType::class, [
            'label' => "Envoyer",
            'attr' =>[
                'class' => 'btn-block btnOrg'
               ]
        ])
        ;
    }
        
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
