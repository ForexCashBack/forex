<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="referrer_id", referencedColumnName="id")
     **/
    protected $referrer;

    /**
     * @ORM\OneToMany(targetEntity="PartialPayout", mappedBy="user")
     **/
    protected $partialPayouts;

    public function __construct()
    {
        parent::__construct();
        $this->accounts = new ArrayCollection();
        $this->partialPayouts = new ArrayCollection();
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
}
