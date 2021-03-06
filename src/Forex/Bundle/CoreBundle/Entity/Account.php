<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Entity
 * @ORM\Table(name="accounts")
 * @Serialize\ExclusionPolicy("all")
 */
class Account
{
    const STATUS_VERIFIED = 'verified';
    const STATUS_UNVERIFIED = 'unverified';
    const STATUS_INVALID = 'invalid';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Serialize\Expose
     */
    protected $accountNumber;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="accounts")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="accounts")
     * @Serialize\Expose
     */
    protected $broker;

    /**
     * @ORM\ManyToOne(targetEntity="BrokerAccountType", inversedBy="accounts")
     * @Serialize\Expose
     */
    protected $brokerAccountType;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="account")
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
    protected $payoutPercentage;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $status = self::STATUS_UNVERIFIED;

    public function __construct(Broker $broker = null, User $user = null)
    {
        $this->broker = $broker;
        $this->user = $user;
        if ($broker) {
            $this->payoutPercentage = $broker->getBasePercentage();
        }

        $this->payments = new ArrayCollection();
        $this->payouts = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setBroker(Broker $broker)
    {
        $this->broker = $broker;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBrokerAccountType(BrokerAccountType $brokerAccountType)
    {
        $this->brokerAccountType = $brokerAccountType;
    }

    public function getBrokerAccountType()
    {
        return $this->brokerAccountType;
    }

    public function addPayment(Payment $payment)
    {
        $this->payments->add($payment);
    }

    public function getPayments()
    {
        return $this->payments;
    }

    public function addPayout(Payout $payout)
    {
        $this->payouts->add($payout);
    }

    public function getPayouts()
    {
        return $this->payouts;
    }

    public function setPayoutPercentage($payoutPercentage)
    {
        $this->payoutPercentage = $payoutPercentage;
    }

    public function getPayoutPercentage()
    {
        return $this->payoutPercentage;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function __toString()
    {
        return (string) $this->id
            ? sprintf(
                'User: %s Broker: %s Acct Number :%s',
                $this->user->getUsername(),
                $this->broker->getName(),
                $this->getAccountNumber()
            )
            : 'New Account';
    }
}
