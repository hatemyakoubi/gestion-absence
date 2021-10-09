<?php

namespace App\Form;

use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin', NumberType::class)
            ->add('firstname', TexTtype::class,[
                'label'=> "Nom"
            ]
        )
            ->add('lastname', TextType::class,[
                'label'=> "Prenom"
            ]
        )
            ->add('diplome', TextType::class)
            ->add('email', EmailType::class)
            ->add('phone', NumberType::class,[
                'label'=> "Téléphone"
            ]
        )
            ->add('contrat', TextType::class)
            ->add('registerAt', DateType::class,[
                'label'=> "Date de récrutement"
            ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
