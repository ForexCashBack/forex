<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A type of account that a broker offers
 *
 * @ORM\Entity
 * @ORM\Table(name="broker_account_types",uniqueConstraints={@ORM\UniqueConstraint(name="unique_broker_account_type_rank", columns={"broker_id", "rank"})})
 * @Serialize\ExclusionPolicy("all")
 */
class BrokerAccountType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="accountTypes")
     */
    protected $broker;

    /**
     * The name of the broker account type
     *
     * @ORM\Column(type="string", length=50)
     * @Serialize\Expose
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="brokerAccountType")
     */
    protected $accounts;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="brokerAccountType")
     */
    protected $payments;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     *      max = 1,
     *      minMessage = "Percentage must be greater than 0",
     *      maxMessage = "Percentage must be less than 1"
     * )
     */
    protected $basePercentage;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0)
     */
    protected $minDeposit;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0)
     */
    protected $maxLeverage;

    /**
     * The plain text of the rate they offer
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $rate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=1000)
     */
    protected $rank;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return BrokerAccountType
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set Broker
     *
     * @param Broker $broker
     * @return BrokerAccountType
     */
    public function setBroker(Broker $broker)
    {
        $this->broker = $broker;
    }

    /**
     * Get broker
     *
     * @return Broker
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return BrokerAccountType
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

    /**
     * Add account
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Account $account
     * @return BrokerAccountType
     */
    public function addAccount(Account $account)
    {
        $this->accounts[] = $account;

        return $this;
    }

    /**
     * Remove account
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Account $account
     */
    public function removeAccount(Account $account)
    {
        $this->accounts->removeElement($account);
    }

    /**
     * Get accounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Add a payment
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Payment $payment
     * @return BrokerAccountType
     */
    public function addPayment(Payment $payment)
    {
        $this->payments->add($payment);

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Payment $payments
     * @return BrokerAccountType
     */
    public function removePayment(Payment $payment)
    {
        $this->payments->removeElement($payment);

        return $this;
    }

    /**
     * Get Payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Set basePercentage
     *
     * @param float $basePercentage
     * @return BrokerAccountType
     */
    public function setBasePercentage($basePercentage)
    {
        $this->basePercentage = $basePercentage;

        return $this;
    }

    /**
     * Get basePercentage
     *
     * @return float
     */
    public function getBasePercentage()
    {
        return $this->basePercentage;
    }

    /**
     * Set minDeposit
     *
     * @param float $minDeposit
     * @return BrokerAccountType
     */
    public function setMinDeposit($minDeposit)
    {
        $this->minDeposit = $minDeposit;

        return $this;
    }

    /**
     * Get minDeposit
     *
     * @return float
     */
    public function getMinDeposit()
    {
        return $this->minDeposit;
    }

    /**
     * Set maxLeverage
     *
     * @param float $maxLeverage
     * @return BrokerAccountType
     */
    public function setMaxLeverage($maxLeverage)
    {
        $this->maxLeverage = $maxLeverage;

        return $this;
    }

    /**
     * Get maxLeverage
     *
     * @return float
     */
    public function getMaxLeverage()
    {
        return $this->maxLeverage;
    }

    /**
     * Set rate
     *
     * @param string $rate
     * @return BrokerAccountType
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set rank
     *
     * @param boolean $rank
     * @return BrokerAccountType
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return boolean
     */
    public function getRank()
    {
        return $this->rank;
    }

    public function __toString()
    {
        return $this->name ?: 'New Broker Account Type';
    }
}
