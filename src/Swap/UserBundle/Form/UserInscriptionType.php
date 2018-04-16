<?php

namespace Swap\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class)
        // ->add('nom', TextType::class)
        ->add('email', TextType::class)
        ->add('password', TextType::class, array(
            'label' => 'Mot de Passe'))
        ->add('verificationMotDePasse', TextType::class, array(
            'label' => 'Verification mot de passe'))
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
