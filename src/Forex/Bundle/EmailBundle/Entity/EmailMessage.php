<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Forex\Bundle\CoreBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An email message
 *
 * @ORM\Entity(repositoryClass="EmailMessageRepository")
 * @ORM\Table(name="email_messages")
 */
class EmailMessage
{
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_ERROR = 'error';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email
     */
    protected $replyTo;

    /**
     * TODO - This needs to allow many emails
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email
     */
    protected $ccEmail;

    /**
     * TODO - This needs to allow many emails
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email
     */
    protected $bccEmail;

    /**
     * @ORM\Column(type="string")
     */
    protected $subjectLine;

    /**
     * @ORM\Column(type="string")
     */
    protected $template;

    /**
     * @ORM\Column(type="text")
     */
    protected $data;

    /**
     * @ORM\ManyToOne(targetEntity="Forex\Bundle\CoreBundle\Entity\User", inversedBy="emails")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="EmailLink", mappedBy="message")
     */
    protected $links;

    /**
     * @ORM\OneToMany(targetEntity="EmailOpen", mappedBy="message")
     */
    protected $opens;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $status = self::STATUS_PENDING;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct($subjectLine, $template, array $data = array())
    {
        $this->subjectLine = $subjectLine;
        $this->template = $template;
        $this->setData($data);
        $this->links = new ArrayCollection();
        $this->opens = new ArrayCollection();
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

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }

    public function getReplyTo()
    {
        return $this->replyTo;
    }

    public function setCcEmail($ccEmail)
    {
        $this->ccEmail;
    }

    public function getCcEmail()
    {
        return $this->ccEmail;
    }

    public function setBccEmail($bccEmail)
    {
        $this->bccEmail = $bccEmail;
    }

    public function getBccEmail()
    {
        return $this->bccEmail;
    }

    public function setSubjectLine($subjectLine)
    {
        $this->subjectLine = $subjectLine;
    }

    public function getSubjectLine()
    {
        return $this->subjectLine;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setData(array $data)
    {
        $this->data = json_encode($data);
    }

    public function getData()
    {
        return json_decode($this->data, true);
    }

    public function getJsonData()
    {
        return $this->data;
    }

    public function setJsonData($jsonData)
    {
        $this->data = $jsonData;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->email = $user->getEmail();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isOpened()
    {
        return $this->getNumOpens() > 0;
    }

    public function getNumOpens()
    {
        return count($this->opens);
    }

    public function isClicked()
    {
        return $this->getNumClicks() > 0;
    }

    public function getNumClicks()
    {
        return array_sum(array_map(function ($link) {
            return $link->getNumClicks();
        }, iterator_to_array($this->links)));
    }

    public function __toString()
    {
        return (string) $this->id
            ? sprintf('%s - %s:%s', $this->id, $this->template, $this->status)
            : 'New Email Message';
    }
}

