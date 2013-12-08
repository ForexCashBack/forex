<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * This represents a payment that we send to a user for a specific account
 *
 * @ORM\Entity
 * @ORM\Table(name="payouts")
 */
class Payout
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="payouts")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="PartialPayout", mappedBy="payout")
     */
    protected $partialPayouts;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->partialPayouts = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBroker(Broker $broker)
    {
        $this->broker = $broker;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount($returnDollars = false)
    {
        return (float) $returnDollars
            ? $this->amount / 100
            : $this->amount;
    }

    public function setPartialPayouts(array $partialPayouts)
    {
        foreach ($partialPayouts as $partialPayment) {
            $this->addPartialPayment($partialPayment);
        }
    }

    public function addPartialPayout(PartialPayout $partialPayout)
    {
        $this->partialPayouts->add($partialPayout);
    }

    public function getPartialPayouts()
    {
        return $this->partialPayouts;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return $this->id
            ? sprintf('%s - %s', $this->id, $this->user->getUsername())
            : 'New Payout';
    }
}
