<?php
namespace Swap\PlatformBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Swap\PlatformBundle\Entity\Service;
use Swap\UserBundle\Entity\User;
// use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FormCreator
{
  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function creation($formBuilder, $request, $entity)
  {  
    if ($request->isMethod('POST')) {
     $formBuilder->handleRequest($request);

      // if ($formBuilder->isValid()) {     
      // $this->em->persist($entity);
      // $this->em->flush();
      // }
    }
  }
}