<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This represents a payment that we receive from a broker for a specific account
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
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="payments")
     */
    protected $account;

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
