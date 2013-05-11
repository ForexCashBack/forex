<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This represents a payment that we send to a user for a specific account
 *
 * @ORM\Entity
 * @ORM\Table(name="partial_payouts")
 */
class PartialPayout
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="payouts")
     */
    protected $account;

    /**
     * @ORM\ManyToOne(targetEntity="Payout", inversedBy="partialPayouts")
     */
    protected $payout;

    /**
     * @ORM\OneToOne(targetEntity="Payment", inversedBy="partialPayout")
     */
    protected $payment;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->account = $payment->getAccount();
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
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function setPayout(Payout $payout)
    {
        $this->payout = $payout;
    }

    public function getPayout()
    {
        return $this->payout;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function __toString()
    {
        return $this->id
            ? sprintf('%s - %s', $this->id, $this->account->getId())
            : 'New Account';
    }
}
