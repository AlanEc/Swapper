<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swap\UserBundle\Entity\User;
use Swap\UserBundle\Entity\UserInscription;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Swap\UserBundle\Form\UserType;
use Swap\UserBundle\Form\UserInscriptionType;

class ProfilController extends Controller
{
  public function accountAction()
  {
  	// $session = new Session();
  	// $idMembre = $session->get('id');
    $user = $this->getUser(); 
    $date = new \Datetime();

// var_dump($reservationToRender[0]->getService()->getUser()->getId());
    return $this->render('SwapPlatformBundle:Swap:monCompte.html.twig', array(
    'user' => $user,
    'reservations' => $user->getReservationsMade(),
    'servicesToRender' => $user->getUserReservation(),
    'date' => $date
    ));
  }

  public function profilAction(Request $request)
  {
    $user = $this->getUser(); 

		$formBuilder = $this->get('form.factory')->create(UserType::class, $user);
		// $form = $this->container->get('Swap_form.FormCreator');
  //   $creationForm = $form->creation($formBuilder, $request, $membre);

     if ($request->isMethod('POST')) {
        $formBuilder->handleRequest($request);

      if ($formBuilder->isSubmitted() && $formBuilder->isValid()) {      
        $file = $user->getImage();
        // $fileName = md5(uniqid()).'.'.$file->guessExtension();
        // $file->move(
        //   $this->getParameter('images_directory'),
        //   $fileName
        // );
        // $fileName = $fileUploader->upload($file);
        $fileUpload = $this->container->get('file_upload');
        $fileName = $fileUpload->upload($file);
        $user->setImage($fileName);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
      }
    }

		return $this->render('SwapPlatformBundle:Swap:profil.html.twig', array(
		'form' => $formBuilder->createView(),
		));
  }

	public function inscriptionAction(Request $request)
  {
    $session = new Session();
		$membreInscription = new User();
		$formBuilder = $this->get('form.factory')->create(UserInscriptionType::class, $membreInscription);

		if ($request->isMethod('POST')) {
		    $formBuilder->handleRequest($request);

  		if ($formBuilder->isValid()) {
  		$em = $this->getDoctrine()->getManager();
  		$membreInscription->setEnabled(true);
  		$em->persist($membreInscription);
  		$em->flush();
  		}

  		$idMembre = $membreInscription->getId();
  		$session->set('id', $idMembre);
  		return $this->redirectToRoute('swap_platform_moncompte');
		}

		return $this->render('SwapPlatformBundle:Swap:inscription.html.twig', array(
		'form' => $formBuilder->createView(),
		));
	}
}		


