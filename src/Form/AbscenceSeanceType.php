<?php

namespace App\Form;


use App\Entity\Candidat;
use App\Entity\SeanceCours;
use Symfony\Component\Form\AbstractType;
use App\Repository\SeanceCoursRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbscenceSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label'=>'Titre'
              ])
             ->add('enseignant', TextType::class)
            ->add('startdateAt',DateTimeType::class,[
                'widget' => 'single_text',
                  'label'=>'Début de cours'
            ])
            ->add('EnddateAt',DateTimeType::class,[
                'widget' => 'single_text',
                'label'=>'Fin de cours'
                ])
            ->add('description', TextareaType::class)
            ->add('candidat', EntityType::class,[
                    'class'=> Candidat::class,
                    'choice_label' => 'firstname',
                            //'expanded'=> true,
                            'multiple' => true,
                            'by_reference' => false,
                            'attr'=>[
                                //'class'=>'seancecours_candidat',
                                'class'=>'select-candidat',
                               
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
