<?php

namespace Swap\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceDetailsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('modeResa', ChoiceType::class, array(
            'label' => 'Mode de Reservation',
            'choices' => array(
               'Reservation instantanée' => 'Reservation instantanée',
               'Rersevation sur demande' => 'Reservation sur demande' ))
        )
        ->add('nombrePersonnes', ChoiceType::class, array(
            'label' => 'Nombre de personnes max.',
            'choices' => array(
               '1' => '1',
               '2' => '2',
               '3' => '3',
               '4' => '4',
               '5' => '5',
               '6' => '6',
               '7' => '7',
               '8' => '8' ))
        )
        ->add('adresse', TextType::class)
        ->add('country', TextType::class, array(
            'label' => false
        ))
        ->add('city', TextType::class, array(
            'label' => false
        ))
        ->add('longitude', TextType::class, array(
            'label' => false
        ))
        ->add('lattitude', TextType::class, array(
            'label' => false
        ))
        ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swap\PlatformBundle\Entity\Service'
        ));
    }
}
