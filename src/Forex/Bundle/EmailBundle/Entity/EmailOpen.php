<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
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

    public function __toString()
    {
        return (string) $this->id
            ? sprintf('%s - %s:%s', $this->user->getUsername(), $this->broker->getName(), $this->getAccountNumber())
            : 'New Account';
    }
}

