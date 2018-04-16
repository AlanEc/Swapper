<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swap\UserBundle\Entity\User;
use Swap\UserBundle\Entity\UserInscription;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Swap\UserBundle\Form\UserType;
use Swap\UserBundle\Form\UserInscriptionType;
use Swap\PlatformBundle\Form\ReservationType;
use Swap\PlatformBundle\Entity\Reservation;

class ReservationController extends Controller
{
	public function resaAction($id, Request $request)
	{
		$reservation = new Reservation();
		$formBuilder = $this->get('form.factory')->create(ReservationType::class, $reservation);
		$form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $reservation);

        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        $service = $repository->find($id);

        $messageRepository = $repositoryService->get('SwapPlatformBundle:Message');

		$idRecipient = $service->getUser()->getId();
		$comments = $messageRepository->commentRecovery($idRecipient);
		$user = $this->getUser(); 
		if ($formBuilder->isValid()) { 
			$reservation->setService($service);
			$user->addReservationsMade($reservation);
			$user->addUserReservation($reservation);
			$reservation->setUserReservation($user);
			if ($service->getModeResa() == 'Reservation sur demande') {
				$reservation->setReservationStatus('pending request');
			}
			$reservation->setUserService($service->getUser());
			$em = $this->getDoctrine()->getManager();
			$calcul = $this->container->get('swap_points.CalculPoints');
        	$totalPoints = $calcul->calcul($reservation);
        	var_dump($reservation->getService()->getSwapPoints());
        	$reservation->setTotalSwapPoints($totalPoints);
	        $em->persist($reservation);
			$em->flush(); 
		}

		$message = $this->container->get('swap_message.Message');
   		$message->constructionMessage($reservation);

		return $this->render('SwapPlatformBundle:Service:focusSwap.html.twig', array(
		'service' => $service,
		'form' => $formBuilder->createView(),
		'comments' => $comments,
		));
    }
}