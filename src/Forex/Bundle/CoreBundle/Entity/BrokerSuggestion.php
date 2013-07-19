<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A user suggestion for a broker
 *
 * @ORM\Entity
 * @ORM\Table(name="broker_suggestions")
 */
class BrokerSuggestion
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
    protected $suggestion;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

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
     * Set suggestion
     *
     * @param string $suggestion
     * @return BrokerSuggestion
     */
    public function setSuggestion($suggestion)
    {
        $this->suggestion = $suggestion;

        return $this;
    }

    /**
     * Get suggestion
     *
     * @return string
     */
    public function getSuggestion()
    {
        return $this->suggestion;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->id
            ? $this->suggestion
            : 'New Broker Suggestion';
    }
}
