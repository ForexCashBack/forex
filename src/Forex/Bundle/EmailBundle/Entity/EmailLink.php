<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An email link is used for tracking clicks of a particular message
 *
 * @ORM\Entity
 * @ORM\Table(name="email_links")
 */
class EmailLink
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $toUrl;

    /**
     * @ORM\ManyToOne(targetEntity="EmailMessage", inversedBy="links")
     */
    protected $message;

    /**
     * @ORM\OneToMany(targetEntity="EmailClick", mappedBy="link")
     */
    protected $clicks;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct($toUrl, EmailMessage $message)
    {
        $this->id = uniqid();
        $this->toUrl = $toUrl;
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

    public function __toString()
    {
        return (string) $this->id
            ? sprintf('%s - %s:%s', $this->id, $this->fromUrl, $this->toUrl)
            : 'New Email Link';
    }
}

