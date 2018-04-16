<?php
namespace Swap\PlatformBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;

class FormFilter
{
	public function creation($request) {  
		$defaultData = array('message' => 'Type your message here');
		$form = $this->createFormBuilder($defaultData)
		->add('date', TextType::class)
		->add('filtrer', SubmitType::class)
		->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
		  // data is an array with "name", "email", and "message" keys
		  $data = $form->getData();
		}
	}
}