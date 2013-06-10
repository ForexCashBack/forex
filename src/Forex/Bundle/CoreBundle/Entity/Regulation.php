<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This represents a regulaton for a broker
 *
 * @ORM\Entity
 * @ORM\Table(name="regulations")
 */
class Regulation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="regulations")
     */
    protected $broker;

    /**
     * @ORM\ManyToOne(targetEntity="Regulator", inversedBy="regulations")
     * @ORM\JoinColumn(name="regulator_id", referencedColumnName="abbr")
     */
    protected $regulator;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url
     */
    protected $url;

    /**
     * Set id
     *
     * @param integer $id
     * @return Broker
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set url
     *
     * @param string $url
     * @return Regulation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set broker
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Broker $broker
     * @return Regulation
     */
    public function setBroker(Broker $broker)
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

    /**
     * Set regulator
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Regulator $regulator
     * @return Regulation
     */
    public function setRegulator(Regulator $regulator)
    {
        $this->regulator = $regulator;

        return $this;
    }

    /**
     * Get regulator
     *
     * @return \Forex\Bundle\CoreBundle\Entity\Regulator
     */
    public function getRegulator()
    {
        return $this->regulator;
    }

    public function __toString()
    {
        return 'new Regulation';
        $this->broker
            ? sprintf('%s - %s', $this->broker->getName(), $this->regulator->getName())
            : 'New Regulation';
    }
}
