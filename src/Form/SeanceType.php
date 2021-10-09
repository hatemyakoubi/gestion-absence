<?php

namespace App\Form;

use App\Entity\Seance;
use App\Entity\Candidat;
use App\Entity\Formation;
use App\Entity\Enseignant;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Repository\FormationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', EntityType::class, [
                'class' => Formation::class,
                'placeholder' => 'Sélectionnez une formation',
                'choice_label' => 'title',
                'query_builder'=> function (FormationRepository $f)
                {
                    return $f ->createQueryBuilder('f')
                            ->orderBy('f.title', 'ASC');
                }
             ])
          
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => 'firstname',
               

            ])
          
         
        ;
                
                $builder->get('title')->addEventListener(

                    FormEvents::POST_SUBMIT,
                    function(FormEvent $event){
                       $form = $event->getForm();
                      
                        $form->getParent()->add('candidat', EntityType::class,[
                                'class'=> Candidat::class, 
                               'choices'=> $form->getData()->getCandidats(),
                             
                               
                               
                             
                        ]);
                            
                    }
                );

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,

        ]);
    }
}
