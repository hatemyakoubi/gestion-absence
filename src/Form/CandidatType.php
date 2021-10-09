<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('cin', NumberType::class)
        ->add('firstName', TextType::class, 
           [
                'label'=> "Nom"
            ]
        )
        ->add('lastname', TextType::class, 
        [
             'label'=> "Prenom"
         ]
     )
        ->add('email',EmailType::class)
        ->add('phone', NumberType::class, 
        [
             'label'=> "Téléphone"
         ]
     )
        ->add('address', TextType::class, 
        [
             'label'=> "Adress"
         ]
     )
        ->add('registrationAt', DateType::class, 
        [
             'label'=> "Date d'inscription"
         ]
     )
        ->add('level', ChoiceType::class,[
          
            
             "choices" => [

                "Primaire" => "Primaire",
                "Secondaire" => "Secondaire",
                "Baccalauréat" => "Baccalauréat",
                "Universitaire" => "Universitaire",
                "Ingénierie" => "Ingénierie",
                "Professionnel" => "Professionnel",
                "BTP" => "BTP",
                "BTS" => "BTS",
                "CAP" => "CAP",

             ],
             'label'=>"Niveau"
             
           
           
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
