<?php

namespace Swap\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="Swap\PlatformBundle\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\UserBundle\Entity\User",inversedBy="services")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="ModeResa", type="string", length=255, nullable=true)
     */
    private $modeResa;

    /**
     * @var int
     *
     * @ORM\Column(name="nombrePersonnes", type="integer", nullable=true)
     */
    private $nombrePersonnes;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="lattitude", type="string", length=255, nullable=true)
     */
    private $lattitude;

    /**
     * @var string
     *
     * @ORM\Column(name="vegetarien", type="string", length=255, nullable=true)
     */
    private $vegetarien;

    /**
     * @var string
     *
     * @ORM\Column(name="swapPoints", type="string", length=255, nullable=true)
     */
    private $swapPoints;

    /**
     * @ORM\OneToMany(targetEntity="Swap\PlatformBundle\Entity\DeletedDate", mappedBy="service", cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true)
     */
    private $deletedDates;

    /**
     * @ORM\OneToMany(targetEntity="Swap\PlatformBundle\Entity\Reservation", mappedBy="service", cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true)
     */
    private $reservations;

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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Service
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        if ($categorie == 'Hebergement') {
            $points = '10';
            $this->swapPoints = $points;
        }

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set modeResa
     *
     * @param string $modeResa
     *
     * @return Service
     */
    public function setModeResa($modeResa)
    {
        $this->modeResa = $modeResa;

        return $this;
    }

    /**
     * Get modeResa
     *
     * @return string
     */
    public function getModeResa()
    {
        return $this->modeResa;
    }

    /**
     * Set nombrePersonnes
     *
     * @param integer $nombrePersonnes
     *
     * @return Service
     */
    public function setNombrePersonnes($nombrePersonnes)
    {
        $this->nombrePersonnes = $nombrePersonnes;

        return $this;
    }

    /**
     * Get nombrePersonnes
     *
     * @return int
     */
    public function getNombrePersonnes()
    {
        return $this->nombrePersonnes;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Service
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set vegetarien
     *
     * @param string $vegetarien
     *
     * @return Service
     */
    public function setVegetarien($vegetarien)
    {
        $this->vegetarien = $vegetarien;

        return $this;
    }

    /**
     * Get vegetarien
     *
     * @return string
     */
    public function getVegetarien()
    {
        return $this->vegetarien;
    }

    /**
     * Set user
     *
     * @param \Swap\UserBundle\Entity\User $user
     *
     * @return Service
     */
    public function setUser(\Swap\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Swap\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reservation
     *
     * @param \Swap\PlatformBundle\Entity\Reservation $reservation
     *
     * @return Service
     */
    public function addReservation(\Swap\PlatformBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \Swap\PlatformBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\Swap\PlatformBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Set swapPoints
     *
     * @param string $swapPoints
     *
     * @return Service
     */
    public function setSwapPoints($swapPoints)
    {
        $this->swapPoints = $swapPoints;

        return $this;
    }

    /**
     * Get swapPoints
     *
     * @return string
     */
    public function getSwapPoints()
    {
        return $this->swapPoints;
    }

    /**
     * Add deletedDate
     *
     * @param \Swap\PlatformBundle\Entity\DeletedDate $deletedDate
     *
     * @return Service
     */
    public function addDeletedDate(\Swap\PlatformBundle\Entity\DeletedDate $deletedDate)
    {
        $this->deletedDates[] = $deletedDate;

        return $this;
    }

    /**
     * Remove deletedDate
     *
     * @param \Swap\PlatformBundle\Entity\DeletedDate $deletedDate
     */
    public function removeDeletedDate(\Swap\PlatformBundle\Entity\DeletedDate $deletedDate)
    {
        $this->deletedDates->removeElement($deletedDate);
    }

    /**
     * Get deletedDates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeletedDates()
    {
        return $this->deletedDates;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Service
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set lattitude
     *
     * @param string $lattitude
     *
     * @return Service
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * Get lattitude
     *
     * @return string
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Service
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Service
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}
