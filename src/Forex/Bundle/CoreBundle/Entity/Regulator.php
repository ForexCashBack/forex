<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This represents a regulatory committee
 *
 * @ORM\Entity
 * @ORM\Table(name="regulators")
 */
class Regulator
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(max=10)
     */
    protected $abbr;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\Url
     */
    protected $url;

    /**
     * @ORM\OneToMany(targetEntity="Regulation", mappedBy="regulator")
     */
    protected $regulations;

    public function __construct()
    {
        $this->regulations = new ArrayCollection();
    }

    /**
     * Set abbr
     *
     * @param string $abbr
     * @return Regulator
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Regulator
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
     * Set url
     *
     * @param string $url
     * @return Regulator
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
     * Add regulation
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Regulation $regulations
     * @return Regulator
     */
    public function addRegulation(Regulation $regulation)
    {
        $this->regulations[] = $regulation;

        return $this;
    }

    /**
     * Remove regulation
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Regulation $regulation
     */
    public function removeRegulation(Regulation $regulation)
    {
        $this->regulations->removeElement($regulation);
    }

    /**
     * Get regulations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegulations()
    {
        return $this->regulations;
    }

    public function __toString()
    {
        return $this->abbr
            ? $this->name
            : 'New Regulator';
    }
}
