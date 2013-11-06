<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @Serialize\ExclusionPolicy("all")
 *
 * Note the ExclusionPolicy is not actually read from this annotation
 * It is setup in: app/serializer/FOSUserBundle/Model.User.yml
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose
     */
    protected $id;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Account",
     *      mappedBy="user",
     *      cascade={"persist", "remove", "merge"},
     *      orphanRemoval=true
     * )
     */
    protected $accounts;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="referrals")
     * @ORM\JoinColumn(name="referrer_id", referencedColumnName="id")
     **/
    protected $referrer;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="referrer")
     **/
    protected $referrals;

    /**
     * @ORM\OneToMany(targetEntity="Payout", mappedBy="user")
     **/
    protected $payouts;

    /**
     * @ORM\OneToMany(targetEntity="PartialPayout", mappedBy="user")
     **/
    protected $partialPayouts;

    /**
     * @ORM\OneToMany(targetEntity="Forex\Bundle\EmailBundle\Entity\EmailMessage", mappedBy="user")
     **/
    protected $emails;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        parent::__construct();
        $this->accounts = new ArrayCollection();
        $this->payouts = new ArrayCollection();
        $this->partialPayouts = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function addAccount(Account $account)
    {
        if (!$this->accounts->contains($account)) {
            $account->setUser($this);
            $this->accounts->add($account);
        }
    }

    public function removeAccount(Account $account)
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->remove($account);
        }
    }

    public function getAccounts()
    {
        return $this->accounts;
    }

    public function setReferrer(User $user)
    {
        $this->referrer = $user;
    }

    public function getReferrer()
    {
        return $this->referrer;
    }

    public function addPayout(Payout $payout)
    {
        $this->payouts[] = $payout;
    }

    public function getPayouts()
    {
        return $this->payouts;
    }

    public function getTotalPayoutAmount($returnDollars = false)
    {
        $cents = array_sum(array_map(function($payout) {
            return $payout->getAmount();
        }, $this->getPayouts()->toArray()));

        return $returnDollars
            ? $cents / 100
            : $cents;
    }

    public function addPartialPayout(PartialPayout $partialPayout)
    {
        $this->partialPayouts[] = $partialPayout;
    }

    public function getPartialPayouts()
    {
        return $this->partialPayouts;
    }

    public function getTotalPartialPayoutAmount()
    {
        return array_sum($this->getPartialPayouts()->map(function($payout) {
            return $payout->getAmount();
        })->toArray());
    }

    public function getCurrentPayoutBalance($returnDollars = false)
    {
        $cents = $this->getTotalPartialPayoutAmount() - $this->getTotalPayoutAmount();

        return $returnDollars
            ? $cents / 100
            : $cents;
    }

    public function getReferrals()
    {
        return $this->referrals;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
