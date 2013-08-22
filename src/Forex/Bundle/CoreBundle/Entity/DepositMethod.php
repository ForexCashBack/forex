<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A deposit method
 *
 * @ORM\Entity
 * @ORM\Table(name="deposit_methods")
 */
class DepositMethod
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
            : 'New Depost Method';
    }
}
