<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is when a record of when a user opens an email
 * Note: This is a potential placeholder for capturing additional metadata
 *
 * @ORM\Entity
 * @ORM\Table(name="email_opens")
 */
class EmailOpen
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EmailMessage", inversedBy="opens")
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(EmailMessage $message)
    {
        $this->message = $message;
        $this->createdAt = new \DateTime();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return (string) $this->id ?: 'New Account';
    }
}

