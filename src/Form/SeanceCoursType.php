<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\Formation;
use App\Entity\Enseignant;
use App\Entity\SeanceCours;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Repository\FormationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SeanceCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', EntityType::class, [
                'class' => Formation::class,
                'placeholder' => 'Sélectionnez une formation',
                'choice_label' => 'title',
                'by_reference' => false,
                'label'=>'Titre',
                'query_builder'=> function (FormationRepository $f)
                {
                    return $f ->createQueryBuilder('f')
                            ->orderBy('f.title', 'ASC');
                },
                
             ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => 'firstname',

            ])
            ->add('startdateAt',DateTimeType::class,[
                'widget' => 'single_text',
                  'label'=>'Début de cours'
            ])
            ->add('EnddateAt',DateTimeType::class,[
                'widget' => 'single_text',
                'label'=>'Fin de cours'
               
                ])
            ->add('description', TextareaType::class)
           ->add('Enregistrer', SubmitType::class,[
                'attr'=>['class'=>'btn-save']
            ] )
       
        ;
             $builder->get('title')->addEventListener(

                    FormEvents::POST_SUBMIT,
                    function (FormEvent $event) {
                        $form = $event->getForm();

                        $form->getParent()->add('candidat', EntityType::class, [
                            'class' => Candidat::class,
                            'choices' => $form->getData()->getCandidats(),
                            'choice_label' => 'firstname',
                            // 'expanded'=> true,
                            'multiple' => true,
                            'by_reference' => false,
                            'attr'=>[
                                //'class'=>'seancecours_candidat',
                                'class'=>'select-candidat',
                               
                             ]
                            

                        ]);

                    }
                );
  
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SeanceCours::class,
        ]);
    }
}
