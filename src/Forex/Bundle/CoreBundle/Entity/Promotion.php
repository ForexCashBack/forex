<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A promotion from a broker
 *
 * @ORM\Entity(repositoryClass="PromotionRepository")
 * @ORM\Table(name="promotions")
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="promotions")
     */
    protected $broker;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $endTime;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $text;

    public function __construct()
    {
        $this->startTime = new \DateTime();
        $this->endTime = new \DateTime();
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
     * Set name
     *
     * @param string $name
     * @return Promotion
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Promotion
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Promotion
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Promotion
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set broker
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Broker $broker
     * @return Promotion
     */
    public function setBroker(Broker $broker = null)
    {
        $this->broker = $broker;

        return $this;
    }

    /**
     * Get broker
     *
     * @return \Forex\Bundle\CoreBundle\Entity\Broker
     */
    public function getBroker()
    {
        return $this->broker;
    }

    public function __toString()
    {
        return $this->id
            ? sprintf('%s - %s (%s - %s)', $this->broker->getName(), $this->name, $this->getStartTime()->format('r'), $this->getEndTime()->format('r'))
            : 'New Promotion';
    }
}
