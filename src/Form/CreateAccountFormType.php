<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\File;

class CreateAccountFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username' , TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Username"],
                'label' => false,

                ])

            ->add('password', RepeatedType::class, [

                'options' => ['attr' => ['class' => 'password-field']],
                'label' => false,
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
                'label' => false,
                'required' => true,])
            ->add('lastname', TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Nom"],
                'label' => false,
                'required' => true,])
            ->add('address', TextType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Adresse"],
                'label' => false,
                'required' => true,])

            ->add('postalcode', IntegerType::class,[
                'attr'=> ['class'=> 'form-control',"placeholder"=>"Code Postal "],
                'label' => false,
                'required' => true,] )

            ->add('description',TextareaType::class,[
                'attr' =>['class'=> 'form-control w-100',"placeholder"=>"Leave a description about you", "cols"=>"30", "rows"=>"10"],
                'label' => false,
                'required' => false,])
            ->add('profilimage',FileType::class,[
                //'attr' =>['class'=> 'form-control'],
                'help' => 'select a image',
                'label' => false,
                'mapped' => false,
                'required' => true,])->add('submit',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'task_item',

        ]);
    }
}
