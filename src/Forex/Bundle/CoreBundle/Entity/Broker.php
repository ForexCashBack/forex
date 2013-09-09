<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Broker
 *
 * @ORM\Entity(repositoryClass="BrokerRepository")
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
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\Length(max=25)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     */
    protected $companyName;

    /**
     * @ORM\Column(type="string")
     * @Assert\Url
     */
    protected $referralLink;

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
     * @ORM\OneToMany(targetEntity="Regulation", mappedBy="broker")
     */
    protected $regulations;

    /**
     * @ORM\ManyToMany(targetEntity="Currency")
     * @ORM\JoinTable(
     *      name="broker_equity_holdings",
     *      joinColumns={@ORM\JoinColumn(name="currency", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="broker", referencedColumnName="abbr")}
     * )
     */
    protected $equityHoldingCurriencies;

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
     * @ORM\Column(type="string")
     * @Assert\Url
     */
    protected $website;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=1900)
     */
    protected $yearFounded;

    /**
     * The plain text of the rate they offer
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $rate;

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

    /**
     * A description of why to use this broker
     *
     * @ORM\Column(type="text")
     */
    protected $highlight;

    /**
     * A description of the spread
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $spread;

    /**
     * The link to the brokers spread
     *
     * @ORM\Column(type="string")
     * @Assert\Url
     */
    protected $spreadLink;

    /**
     * Does the broker accept US clients
     *
     * @ORM\Column(type="boolean")
     */
    protected $usClients;

    /**
     * @ORM\Column(type="integer", unique=true)
     * @Assert\Range(min=0, max=1000)
     */
    protected $rank;

    /**
     * Is the broker active
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->regulations = new ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     * @return Broker
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Add promotion
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Promotion $promotions
     * @return Broker
     */
    public function addPromotion(Promotion $promotions)
    {
        $this->promotions[] = $promotions;

        return $this;
    }

    /**
     * Remove promotion
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Promotion $promotions
     */
    public function removePromotion(Promotion $promotions)
    {
        $this->promotions->removeElement($promotions);
    }

    /**
     * Get promotions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPromotions()
    {
        return $this->promotions;
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
     * Set rate
     *
     * @param string $rate
     * @return Broker
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

    /**
     * Set referralLink
     *
     * @param string $referralLink
     * @return Broker
     */
    public function setReferralLink($referralLink)
    {
        $this->referralLink = $referralLink;

        return $this;
    }

    /**
     * Get referralLink
     *
     * @return string
     */
    public function getReferralLink()
    {
        return $this->referralLink;
    }

    /**
     * Set highlight
     *
     * @param string $highlight
     * @return Broker
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * Get highlight
     *
     * @return string
     */
    public function getHighlight()
    {
        return $this->highlight;
    }

    /**
     * Add regulation
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Regulation $regulation
     * @return Broker
     */
    public function addRegulation(Regulation $regulation)
    {
        $this->regulations[] = $regulation;

        return $this;
    }

    /**
     * Remove regulation
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Regulation $regulation
     */
    public function removeRegulation(Regulation $regulation)
    {
        $this->regulations->removeElement($regulation);
    }

    /**
     * Get regulations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegulations()
    {
        return $this->regulations;
    }

    /**
     * Set spread
     *
     * @param string $spread
     * @return Broker
     */
    public function setSpread($spread)
    {
        $this->spread = $spread;

        return $this;
    }

    /**
     * Get spread
     *
     * @return string
     */
    public function getSpread()
    {
        return $this->spread;
    }

    /**
     * Set spreadLink
     *
     * @param string $spreadLink
     * @return Broker
     */
    public function setSpreadLink($spreadLink)
    {
        $this->spreadLink = $spreadLink;

        return $this;
    }

    /**
     * Get spreadLink
     *
     * @return string
     */
    public function getSpreadLink()
    {
        return $this->spreadLink;
    }

    /**
     * Set usClients
     *
     * @param boolean $usClients
     * @return Broker
     */
    public function setUsClients($usClients)
    {
        $this->usClients = $usClients;

        return $this;
    }

    /**
     * Get usClients
     *
     * @return boolean
     */
    public function getUsClients()
    {
        return $this->usClients;
    }

    /**
     * Add equityHoldingCurriencies
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Currency $equityHoldingCurriencies
     * @return Broker
     */
    public function addEquityHoldingCurriency(Currency $currency)
    {
        $this->equityHoldingCurriencies[] = $currency;

        return $this;
    }

    /**
     * Remove equityHoldingCurriencies
     *
     * @param \Forex\Bundle\CoreBundle\Entity\Currency $equityHoldingCurriencies
     */
    public function removeEquityHoldingCurriency(Currency $currency)
    {
        $this->equityHoldingCurriencies->removeElement($currency);
    }

    /**
     * Get equityHoldingCurriencies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquityHoldingCurriencies()
    {
        return $this->equityHoldingCurriencies;
    }

    /**
     * Set rank
     *
     * @param boolean $rank
     * @return Broker
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

    /**
     * Set active
     *
     * @param boolean $active
     * @return Broker
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    public function __toString()
    {
        return $this->name ?: 'New Broker';
    }
}
