<?php

namespace Forex\Bundle\CoreBundle\Account;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Account\AccountEvents;
use Forex\Bundle\CoreBundle\Account\Event\AccountEvent;
use Forex\Bundle\CoreBundle\Entity\Account;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @DI\Service("forex.account_manager")
 */
class AccountManager
{
    protected $em;
    protected $eventDispatcher;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "eventDispatcher" = @DI\Inject("event_dispatcher"),
     * })
     */
    public function __construct(EntityManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createAccount(Account $account)
    {
        $account->setPayoutPercentage($account->getBroker()->getBasePercentage());

        $accountEvent = $this->createAccountEvent($account);
        $this->eventDispatcher->dispatch(AccountEvents::ACCOUNT_CREATED, $accountEvent);

        $this->em->persist($account);
    }

    protected function createAccountEvent(Account $account)
    {
        return new AccountEvent($account);
    }
}
