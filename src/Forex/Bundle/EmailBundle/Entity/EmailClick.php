<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a click on an email link
 *
 * @ORM\Entity
 * @ORM\Table(name="email_clicks")
 */
class EmailClick
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EmailLink", inversedBy="clicks")
     */
    protected $link;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(EmailLink $link)
    {
        $this->link = $link;
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

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return (string) $this->id
            ? sprintf('%s - %s - %s', $this->id, $this->message->getTemplate(), $this->createdAt->format('c'))
            : 'New Email Click';
    }
}

