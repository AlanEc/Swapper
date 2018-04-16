<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swap\PlatformBundle\Form\MessageType;
use Swap\PlatformBundle\Entity\Message;

class CommentController extends Controller
{
	function sendAction(Request $request, $id) 
	{
		$message = new Message();
    	$formBuilder = $this->get('form.factory')->create(MessageType::class, $message);
    	$form = $this->container->get('Swap_form.FormCreator');
    	$creationForm = $form->creation($formBuilder, $request, $message);

    	$user = $this->getUser();

		$repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:reservation');

		$reservation = $repository->findOneBy(
			array('id' => $id));

		$recipient = $reservation->getUserReservation();

    	if ($formBuilder->isValid()) { 
			$message->setAuthor($user);
			$message->setServiceId($id);
			$message->setRecipient($recipient);
			$message->setComment('1');
			$reservation->setStatus('3');
			$em = $this->getDoctrine()->getManager();
		    $em->persist($message);
			$em->flush(); 

		return $this->redirectToRoute('swap_platform_moncompte');
		}

		return $this->render('SwapPlatformBundle:Comment:comment.html.twig', array(
		'form' => $formBuilder->createView(),
		));
	}
}