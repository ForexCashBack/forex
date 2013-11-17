<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="trading_platforms")
 */
class TradingPlatform
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
    protected $description;

    /**
     * Set abbr
     *
     * @param string $abbr
     * @return TradingPlatform
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
     * Set description
     *
     * @param string $description
     * @return TradingPlatform
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->abbr ?: 'New TradingPlatform';
    }
}
