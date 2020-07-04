<?php

namespace EvenementBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('start', DateType::class )
            ->add('description' )
            ->add('categorie', ChoiceType::class, array(
                'choices'=>array(
                    'Campagne de propreté'=>'Campagne de propreté',
                    'conférence environnementale'=>'conférence environnementale',
                    'jardinage'=>'jardinage',
                    'bricolage recyclage'=>'bricolage recyclage')
            ))
            ->add('heure' ,  TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('Realise', HiddenType::class)
            ->add('place')
            ->add('affiche',FileType::class,array('data_class' =>null))

            ->add('envoyer', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_evenement';
    }


}
