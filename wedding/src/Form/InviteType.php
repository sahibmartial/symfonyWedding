<?php

namespace App\Form;

use App\Entity\Invite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LengthValidator;
use Symfony\Component\Validator\Constraints as Assert;

class InviteType extends AbstractType
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
                ['label'=>'Votre prenom',
                'constraints'=> new Length(['min' => 2,'max' =>30]),
                'attr'=>
                ['placeholder'=>'Merci de saisir votre prenom']
                ])
            ->add('email',EmailType::class,
                ['label'=>'Votre email',
                'constraints'=> new Length(['min' => 2,'max' =>60]),
                'attr'=>['placeholder'=>'Merci de saisir votre mail']
                ])
            ->add('phone',TextType::class,
                ['label'=>'Votre contact',
                'constraints'=> new Length(['min' => 2,'max' =>100]),
                'attr'=>
                ['placeholder'=>'Merci de saisir votre contact']
                ])
            ->add('pays',CountryType::class)         
            ->add('lien',ChoiceType::class,[
                  'choices' => [
                  'Parent_Martial'=>'Parent_Martial',
                   'Parent_Alix' => 'Parent_Alix',
                  'Camarade_Fac_Lycée' =>'Camarade_Fac_Lycée',
                   'Amis&Connaissances'=>'Amis&Connaissances',
                  'CollèguesDeServices'=>'CollèguesDeServices'
                   ],
               ])
            
            ->add('submit',SubmitType::class,
                ['label'=>"Invitation"
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invite::class,
        ]);
    }
}
