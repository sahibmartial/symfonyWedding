<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ListInviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                ['label'=>"Télecharger liste"
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
