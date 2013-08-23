<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A user complaint
 *
 * @ORM\Entity
 * @ORM\Table(name="complaints")
 */
class Complaint
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $complaint;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Broker")
     */
    protected $broker;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

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
     * Set complaint
     *
     * @param string $complaint
     * @return Complaint
     */
    public function setComplaint($complaint)
    {
        $this->complaint = $complaint;

        return $this;
    }

    /**
     * Get complaint
     *
     * @return string
     */
    public function getComplaint()
    {
        return $this->complaint;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Complaint
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set broker
     *
     * @param Broker $broker
     * @return Complaint
     */
    public function setBroker(\Forex\Bundle\CoreBundle\Entity\Broker $broker = null)
    {
        $this->broker = $broker;

        return $this;
    }

    /**
     * Get broker
     *
     * @return Broker
     */
    public function getBroker()
    {
        return $this->broker;
    }

    public function __toString()
    {
        return $this->id ?: 'New Complaint';
    }
}
