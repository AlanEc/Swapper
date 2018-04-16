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

class IndexController extends Controller
{
    public function displayAction()
    {
        return $this->render('SwapPlatformBundle:Swap:index.html.twig');
    }

    public function AdminAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('SwapPlatformBundle:Reservation')->findAll();
        $services = $em->getRepository('SwapPlatformBundle:Service')->findAll();
        $users = $em->getRepository('SwapUserBundle:User')->findAll();

        return $this->render('SwapPlatformBundle:Admin:admin.html.twig', array(
            'reservations' => $reservations,
            'services' => $services,
            'users' => $users,
        ));
    }
}