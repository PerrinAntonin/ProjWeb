<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateAccountFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username' , TextType::class,['attr'=> ['class'=> 'form-control',"placeholder"=>"Username"],])

            ->add('password', RepeatedType::class, [

                'options' => ['attr' => ['class' => 'password-field']],
                'type' => PasswordType::class,
                    'required' => true,
                    'invalid_message' => 'The password fields must match.',
                    'first_options'  => [
                        'attr'=> ['class'=> 'form-control',"placeholder"=>"MDP"],"label"=>false],
                    'second_options' => [
                        'attr'=> ['class'=> 'form-control',"placeholder"=>"Repeat MDP"],"label"=>false,],

                    ])

            ->add('firstname', TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Prénom"],
                'required' => true,])
            ->add('lastname', TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Nom"],
                'required' => true,])
            ->add('address', TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Adresse"],
                'required' => true,])

            ->add('postalcode', IntegerType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Code Postal "],
                'required' => true,] )

            ->add('description',TextareaType::class,[
                'attr' =>['class'=> 'form-control w-100',"placeholder"=>"Leave a description about you", "cols"=>"30", "rows"=>"10"],
                'required' => false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
