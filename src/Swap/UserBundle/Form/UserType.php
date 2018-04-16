<?php

namespace Swap\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class)
        ->add('email', TextType::class)
        ->add('image', FileType::class, array('label' => 'Image',
            'multiple' => true, ))
        ->add('genre', ChoiceType::class, array(
            'label' => 'Genre',
            'choices' => array(
               'M' => 'M',
               'F' => 'F' ))
        )
        ->add('nationalite', TextType::class)
        ->add('profession', TextType::class)
        ->add('description', TextType::class)
        ->add('save', SubmitType::class)
       ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swap\UserBundle\Entity\User'
        ));
    }
}
