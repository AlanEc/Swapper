<?php

namespace Swap\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Swap\PlatformBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // *
    //  * @var string
    //  *
    //  * @ORM\Column(name="statut", type="string", length=255)
     
    // private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="dateDeparture", type="date", length=255)
     */
    private $dateDeparture;

    /**
     * @var string
     *
     * @ORM\Column(name="dateArrival", type="date", length=255)
     */
    private $dateArrival;

    /**
     * @var string
     *
     * @ORM\Column(name="totalSwapPoints", type="string", length=255)
     */
    private $totalSwapPoints;

    /**
     * @var status
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var ReservationStatus
     *
     * @ORM\Column(name="ReservationStatus", type="string", length=255, nullable=true)
     */
    private $ReservationStatus;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\UserBundle\Entity\User",inversedBy="reservationsMade")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userReservation;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\UserBundle\Entity\User",inversedBy="userReservation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userService;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\PlatformBundle\Entity\Service",inversedBy="reservations")
     * @ORM\JoinColumn(nullable=true)
     */
    private $service;

    const RESA_WAITING = 0;
    const RESA_ACCEPTED = 1;
    const OLD_RESA = 2;
    const DELETE_STATUS = 3;

    public function __construct() 
    {
        $this->resaStatus();
    }

    public function resaStatus() {
        $date = new \Datetime();
        if ($this->dateDeparture > $date){
            $this->setStatus(self::RESA_ACCEPTED);
        }
        if ($this->dateDeparture < $date) {
            $this->setStatus(self::OLD_RESA);
        }
    }

    public function DeleteNotification() {
        $status = '3';
        $this->setStatus($status);
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Reservation
     */
    public function setStatus($status)
    {
        $this->status = $status;       

        return $this; 
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateDeparture
     *
     * @param string $dateDeparture
     *
     * @return Reservation
     */
    public function setDateDeparture($dateDeparture)
    {
        $this->dateDeparture = $dateDeparture;

        return $this;
    }

    /**
     * Get dateDeparture
     *
     * @return string
     */
    public function getDateDeparture()
    {
        return $this->dateDeparture;
    }

    /**
     * Set dateArrival
     *
     * @param string $dateArrival
     *
     * @return Reservation
     */
    public function setDateArrival($dateArrival)
    {
        $this->dateArrival = $dateArrival;

        return $this;
    }

    /**
     * Get dateArrival
     *
     * @return string
     */
    public function getDateArrival()
    {
        return $this->dateArrival;
    }

    /**
     * Set userReservation
     *
     * @param \Swap\UserBundle\Entity\User $userReservation
     *
     * @return Reservation
     */
    public function setUserReservation(\Swap\UserBundle\Entity\User $userReservation)
    {
        $this->userReservation = $userReservation;

        return $this;
    }

    /**
     * Get userReservation
     *
     * @return \Swap\UserBundle\Entity\User
     */
    public function getUserReservation()
    {
        return $this->userReservation;
    }

    /**
     * Set userService
     *
     * @param \Swap\UserBundle\Entity\User $userService
     *
     * @return Reservation
     */
    public function setUserService(\Swap\UserBundle\Entity\User $userService)
    {
        $this->userService = $userService;

        return $this;
    }

    /**
     * Get userService
     *
     * @return \Swap\UserBundle\Entity\User
     */
    public function getUserService()
    {
        return $this->userService;
    }

    /**
     * Set service
     *
     * @param \Swap\PlatformBundle\Entity\Service $service
     *
     * @return Reservation
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Swap\PlatformBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }


    /**
     * Set totalSwapPoints
     *
     * @param \DateTime $totalSwapPoints
     *
     * @return Reservation
     */
    public function setTotalSwapPoints($totalSwapPoints)
    {
        $this->totalSwapPoints = $totalSwapPoints;

        return $this;
    }

    /**
     * Get totalSwapPoints
     *
     * @return \DateTime
     */
    public function getTotalSwapPoints()
    {
        return $this->totalSwapPoints;
    }

    /**
     * Set reservationStatus
     *
     * @param string $reservationStatus
     *
     * @return Reservation
     */
    public function setReservationStatus($reservationStatus)
    {
        $this->ReservationStatus = $reservationStatus;

        return $this;
    }

    /**
     * Get reservationStatus
     *
     * @return string
     */
    public function getReservationStatus()
    {
        return $this->ReservationStatus;
    }
}
