<?php

namespace Swap\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="deletedDates")
 * @ORM\Entity(repositoryClass="Swap\PlatformBundle\Repository\DeletedDateRepository")
 */
class DeletedDate
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
     * @var string
     *
     * @ORM\Column(name="minDate", type="string", nullable=true)
     */
    private $minDate;

    /**
     * @var string
     *
     * @ORM\Column(name="maxDate", type="string", nullable=true)
     */
    private $maxDate;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\PlatformBundle\Entity\Service",inversedBy="deletedDates")
     * @ORM\JoinColumn(nullable=true)
     */
    private $service;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set service
     *
     * @param \Swap\PlatformBundle\Entity\Service $service
     *
     * @return DeletedDate
     */
    public function setService(\Swap\PlatformBundle\Entity\Service $service = null)
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
     * Set minDate
     *
     * @param string $minDate
     *
     * @return DeletedDate
     */
    public function setMinDate($minDate)
    {
        $this->minDate = $minDate;

        return $this;
    }

    /**
     * Get minDate
     *
     * @return string
     */
    public function getMinDate()
    {
        return $this->minDate;
    }

    /**
     * Set maxDate
     *
     * @param string $maxDate
     *
     * @return DeletedDate
     */
    public function setMaxDate($maxDate)
    {
        $this->maxDate = $maxDate;

        return $this;
    }

    /**
     * Get maxDate
     *
     * @return string
     */
    public function getMaxDate()
    {
        return $this->maxDate;
    }
}
