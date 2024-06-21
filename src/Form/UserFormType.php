<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'mt-4 form-control'
                ],
                'label' => 'Username:',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'mt-4 form-control'
                ],
                'label' => 'Email:',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password',
            'label_attr'=> [
                'class' => 'form-label'
            ]],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'mt-4 form-control'
                ],
                'label' => 'Create new account'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
