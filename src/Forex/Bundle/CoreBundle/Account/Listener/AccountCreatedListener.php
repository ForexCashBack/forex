<?php

namespace Forex\Bundle\CoreBundle\Account\Listener;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Account\Event\AccountEvent;
use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\EmailBundle\Email\EmailMessageManager;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.core.account.event_listener.account_created")
 */
class AccountCreatedListener
{
    protected $emailSender;
    protected $emailMessageManager;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "emailMessageManager" = @DI\Inject("forex.email_message_manager"),
     * })
     */
    public function __construct(EntityManager $em, EmailMessageManager $emailMessageManager)
    {
        $this->em = $em;
        $this->emailMessageManager = $emailMessageManager;
    }

    /**
     * @DI\Observe("forex.account.created")
     */
    public function onAccountCreated(AccountEvent $accountEvent)
    {
        $message = $this->createAccountCreatedEmailMessage($accountEvent->getAccount());

        if ($message) {
            $this->em->persist($message);
        }
    }

    protected function createAccountCreatedEmailMessage(Account $account)
    {
        $broker = $account->getBroker();
        $user = $account->getUser();

        $email = $broker && $broker->getAccountConfirmationEmail()
            ? $broker->getAccountConfirmationEmail()
            : 'accounts@forexcashback.com';

        $subjectLine = 'Please Verify Account';
        $template = 'Account:Verification\broker';
        $data = array(
            'user' => $user,
            'account' => $account,
            'broker' => $broker,
        );

        $message = $this->emailMessageManager->createEmailMessage($subjectLine, $template, $data);
        $message->setEmail($email);
        $message->setReplyTo('accounts@forexcashback.com');

        return $message;
    }
}
