<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NotificationController extends Controller
{
	function deleteAction($id)
	{
		$repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Reservation');

		$reservation = $repository->findOneBy(
		array('id' => $id));
 		$reservation->DeleteNotification();

		$user = $this->getUser(); 
   		$date = new \Datetime();
   		$em = $this->getDoctrine()->getManager();
   		$em->persist($user);
        $em->flush();

	    return $this->render('SwapPlatformBundle:Swap:monCompte.html.twig', array(
	    'user' => $user,
	    'reservations' => $user->getReservationsMade(),
	    'servicesToRender' => $user->getUserReservation(),
	    'date' => $date
	    ));
	}
}