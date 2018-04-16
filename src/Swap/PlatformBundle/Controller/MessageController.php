<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swap\PlatformBundle\Entity\Serivce;
use Swap\PlatformBundle\Form\MessageType;
use Swap\PlatformBundle\Form\ServiceDetailsType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Swap\PlatformBundle\Entity\Service;
use Swap\UserBundle\Entity\User;
use Swap\PlatformBundle\Entity\Message;

class MessageController extends Controller
{
	public function sendMessageAction($id, $idUser, Request $request)
    {
    	$message = new Message();
    	$formBuilder = $this->get('form.factory')->create(MessageType::class, $message);
    	$form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $message);

        $user = $this->getUser(); 

		$repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapUserBundle:User');

		$recipient = $repository->findOneBy(
			array('id' => $idUser));
 
		if ($formBuilder->isValid()) { 
			$message->setAuthor($user);
			$message->setServiceId($id);
			$message->setRecipient($recipient);
			$em = $this->getDoctrine()->getManager();
		    $em->persist($message);
			$em->flush(); 

		return $this->redirectToRoute('swap_platform_moncompte');
		}

		return $this->render('SwapPlatformBundle:Service:messageSwap.html.twig', array(
		'form' => $formBuilder->createView(),
		));
    }

    public function mailBoxAction(Request $request) 
    {
    	$idUser = $this->getUser()->getId();

		$repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Message');

		$listMessage = $repository->recuperationConversation($idUser);

    	return $this->render('SwapPlatformBundle:Service:mailBox.html.twig', array(
		'listMessage' => $listMessage,
		'idUser' => $idUser,
		));
    }

    public function conversationAction($serviceId, $idMessage, $recipientId, Request $request) 
    {
    	$message = new Message();
    	$formBuilder = $this->get('form.factory')->create(MessageType::class, $message);
    	$form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $message);

        $user = $this->getUser(); 

		$repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Message');

		$listMessage = $repository->findBy(
			array('parentId' => $idMessage));

		$messageParent = $repository->findOneBy(
			array('id' => $idMessage));

		$recipientMessageParent = $messageParent->getRecipient();
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

		$service = $repository->findOneBy(
			array('id' => $serviceId));
 
		if ($formBuilder->isValid()) { 

			$repository = $repositoryService->get('SwapUserBundle:User');

			if ($user == $recipientMessageParent ) {
				$recipient = $repository->findOneBy(
					array('id' => $message->getRecipient()));

				$message->setAuthor($user);
				$message->setParentId($idMessage);
				$message->setServiceId($serviceId);
				$message->setRecipient($messageParent->getAuthor());
				$em = $this->getDoctrine()->getManager();
		        $em->persist($message);
				$em->flush();

		} else {

			$recipient = $repository->findOneBy(
				array('id' => $recipientMessageParent));

			$message->setAuthor($user);
			$message->setParentId($idMessage);
			$message->setServiceId($serviceId);
			$message->setRecipient($recipient);
			$em = $this->getDoctrine()->getManager();
	        $em->persist($message);
			$em->flush(); 
		}}

    	return $this->render('SwapPlatformBundle:Message:conversation.html.twig', array(
    	'listMessage' => $listMessage,
    	'messageParent' => $messageParent,
    	'service' => $service,
    	'userId' => $user->getId(),
		'form' => $formBuilder->createView(),
		));
    }
}