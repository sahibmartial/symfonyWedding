<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LengthValidator;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,
                ['label'=>'Votre nom',
                'constraints'=> new Length(['min' => 2,'max' =>30]),
                'attr'=>
                ['placeholder'=>'Merci de saisir votre nom']
                ])
            ->add('prenom',TextType::class,
                ['label'=>'Votre nom',
                'constraints'=> new Length(['min' => 2,'max' =>30]),
                'attr'=>
                ['placeholder'=>'Merci de saisir votre prenom']
                ])
            ->add('email',EmailType::class,
                ['label'=>'Votre email',
                'constraints'=> new Length(['min' => 2,'max' =>60]),
                'attr'=>['placeholder'=>'Merci de saisir votre mail']
                ])
            ->add('content',TextareaType::class,['label'=>"Message"])
            ->add('submit',SubmitType::class,
                ['label'=>"Invitation"
                ])     
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
