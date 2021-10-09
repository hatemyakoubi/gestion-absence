<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\Formation;
use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AffecteSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enseignant',EntityType::class,[
                'class' => Enseignant::class,
                'choice_label' => 'firstname'     
            ])
            ->add('formation',EntityType::class,[
                'class' => Formation::class,
                'choice_label' => 'title'     
            ])
            ->add('condidat',EntityType::class,[
                'class' => Candidat::class,
                'choice_label' => 'firstName'     
            ])
            ->add('dateseanceAt', DateType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
    
}
