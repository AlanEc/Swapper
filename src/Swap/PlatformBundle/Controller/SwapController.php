<?php

namespace Swap\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swap\PlatformBundle\Entity\Serivce;
use Swap\PlatformBundle\Form\ServiceType;
use Swap\PlatformBundle\Form\DeletedDateType;
use Swap\PlatformBundle\Form\ServiceDetailsType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swap\PlatformBundle\Entity\Service;
use Swap\PlatformBundle\Entity\DeletedDate;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Swap\UserBundle\Entity\User;

class SwapController extends Controller
{
    public function addSwapAction(Request $request)
    {
        $service = new Service();
        $user = new User();
        $formBuilder = $this->get('form.factory')->create(ServiceType::class, $service);
        $form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $service);

        if ($formBuilder->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('swap_ajouter_service_details', array(
                'id' => $service->getId()
            ));
        }

        return $this->render('SwapPlatformBundle:Service:ajouterSwap.html.twig', array(
            'form' => $formBuilder->createView(),
        ));
    }

    public function deleteSwapAction($serviceId, $delete)
    {

        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        $service = $repository->find($id);

        $service = $repository->find($serviceId);

        if ($delete == 'yes') {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();

            return $this->redirectToRoute('swap_manage_swap');
        }

        return $this->render('SwapPlatformBundle:Swap:deleteSwap.html.twig', array(
            'serviceId' => $serviceId
        ));
    }

    public function detailsSwapAction($id, Request $request)
    {
        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        $user = $this->getUser();
        $service = $repository->find($id);

        $formBuilder = $this->get('form.factory')->create(ServiceDetailsType::class, $service);
        $form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $service);

        $service->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->render('SwapPlatformBundle:Service:detailsSwap.html.twig', array(
            'form' => $formBuilder->createView(),
        ));
    }

    public function searchAction(Request $request)
    {
        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        if (isset($_POST['adresse'])) {
            $adresse = $_POST['adresse'];
            $listSwaps = $repository->findBy(
                array('city' => $adresse)
            );
        } else {
            $adresse = "";
        }
        $listSwaps = $repository->swapsByAdress($adresse);
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('dateArrival', TextType::class, array(
                'label' => 'Du : '
            ))
            ->add('dateDeparture', TextType::class, array(
                'label' => 'Au  : '
            ))
            ->add('dateDeparture', TextType::class, array(
                'label' => 'Au  : '
            ))
            ->add('numberPersons', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    '1 voyageur' => '1',
                    '2 voyageur' => '2',
                    '3 voyageur' => '3',
                    '4 voyageur' => '4',
                    '5 voyageurs et plus' => '5'
                )))
            ->add('meal', CheckboxType::class, array(
                'label' => 'Repas ',
                'required' => false,
            ))
            ->add('accomodation', CheckboxType::class, array(
                'label' => 'Herbergement ',
                'required' => false,
            ))
            ->add('filtrer', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repositoryService = $this->container->get('Swap.Repository');
            $repository = $repositoryService->get('SwapPlatformBundle:Service');

            $data = $form->getData();

            if ($data['meal'] == true) {
                $meal = "Repas";
            } else {
                $meal = '';
            }
            if ($data['accomodation'] == true) {
                $accomodation = "Hebergement";
            } else {
                $accomodation = "";
            }
            if ($data['meal'] == true) {
                $listSwaps = $repository->findBy(
                    array('nombrePersonnes' => $data['numberPersons'], 'categorie' => $meal)
                );
            }
            if ($data['accomodation'] == true) {
                $listSwaps = $repository->findBy(
                    array('nombrePersonnes' => $data['numberPersons'], 'categorie' => $accomodation)
                );
            }
            // else {
            //   $listSwaps = $repository->findBy(
            //   array('nombrePersonnes' => $data['numberPersons'])
            // );
            // }
        }

        return $this->render('SwapPlatformBundle:Service:searchSwap.html.twig', array(
            'listSwaps' => $listSwaps,
            'form' => $form->createView(),
            'adresse' => $adresse,
        ));
    }

    public function manageMySwapsAction()
    {
        $user = $this->getUser();
        return $this->render('SwapPlatformBundle:Swap:mySwaps.html.twig', array(
            'user' => $user,
            'services' => $user->getServices(),
        ));
    }

    public function reactivateDateAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $request->get('data');

            if ($data) {
                $repositoryService = $this->container->get('Swap.Repository');
                $repository = $repositoryService->get('SwapPlatformBundle:DeletedDate');

                $reactivateDate = $repository->find($data);

                $em = $this->getDoctrine()->getManager();
                $em->remove($reactivateDate);
                $em->flush();

                return new JsonResponse();
            } else {
                return new JsonResponse(array('error' => 'true'));
            }
        } else {
            throw new NotFoundHttpException('Ce n\'est pas une requette ajax');
        }
    }

    public function manageCalendarAction($serviceId, Request $request)
    {
        $deletedDate = new DeletedDate;
        $formBuilder = $this->get('form.factory')->create(DeletedDateType::class, $deletedDate);
        $form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $deletedDate);

        $user = $this->getUser();

        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        $service = $repository->find($serviceId);

        if ($formBuilder->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $service->addDeletedDate($deletedDate);
            $deletedDate->setService($service);
            $em->persist($deletedDate);
            $em->flush();
        }

        $max = sizeof($service->getDeletedDates());
        if ($max >= 1) {
            for ($i = 0; $i < $max; $i++) {
                $minDate = $service->getDeletedDates()[$i]->getMinDate();
                $maxDate = $service->getDeletedDates()[$i]->getMaxDate();
                if ($minDate != null) {
                    $rangeDate = $minDate;
                    $allDeletedDates[$i] = $rangeDate;
                } else {
                    $date = $minDate;
                }
            }
        } else {
            $allDeletedDates = null;
        }

        return $this->render('SwapPlatformBundle:Swap:calendar.html.twig', array(
            'form' => $formBuilder->createView(),
            'user' => $user,
            'service' => $service,
            // 'allDeletedDates' => $allDeletedDates,
        ));
    }

    public function ajaxAction(Request $request)
    {
        // $output ='kk';
        // if ($request->isXmlHttpRequest()) {

        $repositoryService = $this->container->get('Swap.Repository');
        $repository = $repositoryService->get('SwapPlatformBundle:Service');

        $output[] = $_POST;
        // $a = $output['0']['swlat'];
        // $b = $output['0']['swlng'];
        // $decode = $request->request->get('swlat');
        // var_dump($output);
        //   $services = $this->getDoctrine()
        //   ->getRepository(Service::class)
        // $json[] = json_decode($output);
        //   ->serviceRecovery($data);
        $listSwaps = $repository->swapsByCoord($output[0]);
        // var_dump($listSwaps);
        // if ($listSwaps) {
        foreach ($listSwaps as $swap) {

            $aa[] = array('Latitude' => $swap->getLattitude(), 'Longitude' => $swap->getLongitude());
        }
        return new JsonResponse($aa);
        //   }

        //   else {
        //     return new JsonResponse(array('error' => 'true'));
        //   }

        // }

        // else {
        //   throw new NotFoundHttpException('Ce n\'est pas une requette ajax');
        // }
        // }
    }
}