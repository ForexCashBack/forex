<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="brokers")
 */
class Broker
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="broker")
     */
    protected $accounts;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="broker")
     */
    protected $payments;

    /**
     * @ORM\Column(type="float")
     */
    protected $basePercentage;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function addPayment(Payment $payment)
    {
        $this->payments->add($payment);
    }

    public function getPayments()
    {
        return $this->payments;
    }

    public function setBasePercentage($basePercentage)
    {
        $this->basePercentage = $basePercentage;
    }

    public function getBasePercentage()
    {
        return $this->basePercentage;
    }

    public function __toString()
    {
        return $this->name ?: 'New Broker';
    }
}
