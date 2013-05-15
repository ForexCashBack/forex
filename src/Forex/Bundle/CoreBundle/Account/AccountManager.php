<?php

namespace Forex\Bundle\CoreBundle\Account;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Entity\Account;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.account_manager")
 */
class AccountManager
{
    protected $em;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager")
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createAccount(Account $account)
    {
        $account->setPayoutPercentage($account->getBroker()->getBasePercentage());

        $this->em->persist($account);
    }
}
