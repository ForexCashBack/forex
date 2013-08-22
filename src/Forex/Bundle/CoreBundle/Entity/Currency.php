<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A currency
 * Not intended to be a robust representation only a placeholder for association with brokers
 *
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=5)
     * @Assert\Length(max=5)
     */
    protected $abbr;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     */
    protected $name;

    /**
     * Set abbr
     *
     * @param string $abbr
     * @return Currency
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
     * @return Currency
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

    public function __toString()
    {
        return $this->abbr
            ? $this->name
            : 'New Currency';
    }
}
