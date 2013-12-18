<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This represents an amount that we will group together into a payout
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="partialPayouts")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Payout", inversedBy="partialPayouts")
     */
    protected $payout;

    /**
     * @ORM\ManyToOne(targetEntity="Payment", inversedBy="partialPayouts")
     */
    protected $payment;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $amount;

    /**
     * ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(Payment $payment)
    {
        $this->setPayment($payment);
        $this->createdAt = new \DateTime();
    }

    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
        $this->payment->addPartialPayout($this);
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
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
        $this->amount = round($amount);
    }

    public function getAmount($returnDollars = false)
    {
        return $returnDollars
            ? $this->amount / 100
            : $this->amount;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->id
            ? sprintf(
                'Id: %s User: %s Amount: %s',
                $this->id,
                $this->user->getUsername(),
                $this->getAmount(true)
            )
            : 'New Payment';
    }
}
