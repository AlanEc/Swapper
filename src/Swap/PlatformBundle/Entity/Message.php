<?php

namespace Swap\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Swap\PlatformBundle\Repository\MessageRepository")
 */
class Message
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
     * @var int
     *
     * @ORM\Column(name="serviceId", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\UserBundle\Entity\User",inversedBy="sendMessage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Swap\UserBundle\Entity\User",inversedBy="recipientMessage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $recipient;

    /**
     * @var int
     *
     * @ORM\Column(name="parenId", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="comment", type="integer", nullable=true)
     */
    private $comment;


    public function __construct() 
    {
        $this->date = new \Datetime();
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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set service
     *
     * @param \Swap\PlatformBundle\Entity\Service $service
     *
     * @return Comment
     */
    public function setService(\Swap\PlatformBundle\Entity\Service $service)
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
     * Set author
     *
     * @param $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set recipient
     *
     * @param 
     *
     * @return Comment
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return \Swap\UserBundle\Entity\User
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set serviceId
     *
     * @param integer $serviceId
     *
     * @return Message
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return integer
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return Message
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date->format('d-m-Y H:i:s');;
    }

    /**
     * Set comment
     *
     * @param integer $comment
     *
     * @return Message
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return integer
     */
    public function getComment()
    {
        return $this->comment;
    }
}
