<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Broker
 *
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
     * @ORM\Column(type="string", length=100)
     * @Assert\MaxLength(100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\MaxLength(100)
     */
    protected $companyName;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="broker")
     */
    protected $accounts;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="broker")
     */
    protected $payments;

    /**
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="broker")
     */
    protected $promotions;

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
     * @Assert\Min(0)
     */
    protected $minDeposit;

    /**
     * @ORM\Column(type="float")
     * @Assert\Min(0)
     */
    protected $maxLeverage;

    /**
     * @ORM\Column(type="string")
     * @Assert\Url
     */
    protected $website;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Min(1900)
     */
    protected $yearFounded;

    /**
     * The path to the image relative to the web directory
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $rectangleImagePath;

    /**
     * The path to the image relative to the web directory
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $squareImagePath;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Broker
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
     * Set name
     *
     * @param string $name
     * @return Broker
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
     * Set companyName
     *
     * @param string $companyName
     * @return Broker
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Add account
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Account $account
     * @return Broker
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
     * @return Broker
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
     * @return Broker
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
     * @return Broker
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
     * @return Broker
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
     * @return Broker
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
     * Set website
     *
     * @param string $website
     * @return Broker
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set yearFounded
     *
     * @param integer $yearFounded
     * @return Broker
     */
    public function setYearFounded($yearFounded)
    {
        $this->yearFounded = $yearFounded;

        return $this;
    }

    /**
     * Get yearFounded
     *
     * @return integer
     */
    public function getYearFounded()
    {
        return $this->yearFounded;
    }

    /**
     * Set rectangleImagePath
     *
     * @param string $rectangleImagePath
     * @return Broker
     */
    public function setRectangleImagePath($rectangleImagePath)
    {
        $this->rectangleImagePath = $rectangleImagePath;

        return $this;
    }

    /**
     * Get rectangleImagePath
     *
     * @return string
     */
    public function getRectangleImagePath()
    {
        return $this->rectangleImagePath;
    }

    /**
     * Set squareImagePath
     *
     * @param string $squareImagePath
     * @return Broker
     */
    public function setSquareImagePath($squareImagePath)
    {
        $this->squareImagePath = $squareImagePath;

        return $this;
    }

    /**
     * Get squareImagePath
     *
     * @return string
     */
    public function getSquareImagePath()
    {
        return $this->squareImagePath;
    }

    public function __toString()
    {
        return $this->name ?: 'New Broker';
    }
}
