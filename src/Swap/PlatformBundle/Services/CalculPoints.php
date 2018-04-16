<?php
namespace Swap\PlatformBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CalculPoints
{
  public function calcul($reservation)
  {  
    $datetime1 = $reservation->getDateArrival();
    $datetime2 = $reservation->getDateDeparture();
    $interval = $datetime1->diff($datetime2);

    $totalDays = $interval->format('%d');

    $t = $totalDays * $reservation->getService()->getSwapPoints();
    return $t;
  }
}