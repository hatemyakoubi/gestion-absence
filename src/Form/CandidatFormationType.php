<?php

namespace App\Form;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CandidatFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('formation',EntityType::class,[
                'class' => Formation::class,
                'choice_label' => 'title', 
                 'query_builder'=> function (FormationRepository $f)
                {
                    return $f ->createQueryBuilder('f')
                            ->orderBy('f.title', 'ASC');
                },    
                'by_reference'=> false     
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
