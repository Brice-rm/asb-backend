<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class ,[
            'label' => 'Votre email',
            'constraints' =>  new Length([
                'min' => 2,
                'max' => 60,
            ]),
        ])
        ->add('password', RepeatedType::class, [
            'type'=> PasswordType::class,
            'invalid_message' => 'Les mot de passes doivent etre identique',
            'label' => 'Votre mot de passe',
            'required' => true,
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmez votre mot de passe']
        ])
        
        ->add('submit', SubmitType::class, [
            'label' => "S'inscrire",
            'attr' =>[
                'class' => 'btn btn-light'
               ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
