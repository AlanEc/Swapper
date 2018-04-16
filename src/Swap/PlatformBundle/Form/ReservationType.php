<?php

namespace Swap\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dateArrival', DateType::class, array(
            'label' => 'Du',
            'html5' => false,
            'widget' => 'single_text',
        ))
        ->add('dateDeparture', DateType::class, array(
            'label' => 'Au',
            'html5' => false,
            'widget' => 'single_text',
        ))
        ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swap\PlatformBundle\Entity\Reservation'
        ));
    }
}