<?php
namespace Swap\PlatformBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Swap\PlatformBundle\Entity\Reservation;

class Message
{

  private $mailer;
  private $templating;


  public function __construct(\Swift_Mailer $mailer, $templating)
  {
    $this->mailer = $mailer;
    $this->templating = $templating;
  }

  public function constructionMessage($reservaion)
  {
    // $billets = $commande->getBillets();

    // $dateCommande = $commande->getDate();
    // $formatDateCommande = $dateCommande->format('Y-m-d H:i:s');
    // $date = \DateTime::createFromFormat('Y-m-d H:i:s', $formatDateCommande);
    // $date = $date->format('Y-m-d H:i:s');

    $message = (new \Swift_Message('Hello Email'));
    $imgUrl = $message->embed(\Swift_Image::fromPath('http://www.amisdulouvre.fr/images/actualite/logo-louvre.jpg'));
    $message
    ->setSubject('Validation de votre commande')
    ->setFrom('projetopenc@gmail.com')
    ->setTo('alan.ecalle@laposte.net')
    ->setCharset('utf-8')
    ->setContentType('text/html')
    ->setBody($this->templating->render('SwapPlatformBundle:Message:mail.html.twig'
    ), 'text/html'
    );

    $this->mailer->send($message);
  }
}