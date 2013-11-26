<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * This represents a payment that we receive from a broker for a specific account
 * Each payment will create one or more associated partial payment.
 *
 * @ORM\Entity
 * @ORM\Table(name="payments")
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="payments")
     */
    protected $broker;

    /**
     * @ORM\ManyToOne(targetEntity="BrokerAccountType", inversedBy="payments")
     */
    protected $brokerAccountType;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="payments")
     */
    protected $account;

    /**
     * @ORM\OneToMany(targetEntity="PartialPayout", mappedBy="payment")
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
        $this->partialPayouts = new ArrayCollection();
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

    public function setBroker(Broker $broker)
    {
        $this->broker = $broker;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setAccount(Account $account)
    {
        $this->account = $account;
        $this->setBroker($account->getBroker());
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount($returnDollars = false)
    {
        return $returnDollars
            ? $this->amount / 100
            : $this->amount;
    }

    public function addPartialPayout(PartialPayout $partialPayout)
    {
        if (!$this->partialPayouts->contains($partialPayout)) {
            $this->partialPayouts->add($partialPayout);
        }
    }

    public function removePartialPayout(PartialPayout $partialPayout)
    {
        $this->partialPayouts->removeElement($partialPayout);
    }

    public function getPartialPayouts()
    {
        return $this->partialPayouts;
    }

    public function __toString()
    {
        return $this->id
            ? sprintf(
                'Id: %s Broker: %s Account: %s Amount: %d',
                $this->id,
                $this->getAccount()->getBroker()->getSlug(),
                $this->account->getId(),
                $this->getAmount(true)
            )
            : 'New Account';
    }
}
