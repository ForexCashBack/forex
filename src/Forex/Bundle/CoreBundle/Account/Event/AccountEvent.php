<?php

namespace Forex\Bundle\CoreBundle\Account\Event;

use Forex\Bundle\CoreBundle\Entity\Account;
use Symfony\Component\EventDispatcher\Event;

class AccountEvent extends Event
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getAccount()
    {
        return $this->account;
    }
}
