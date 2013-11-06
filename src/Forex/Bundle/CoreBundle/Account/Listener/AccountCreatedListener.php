<?php

namespace Forex\Bundle\CoreBundle\Account\Listener;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Account\Event\AccountEvent;
use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.core.account.event_listener.account_created")
 */
class AccountCreatedListener
{
    protected $emailSender;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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
        // TODO - Use some serializers?
        $data = array(
            'user' => array(
                'email' => $user->getEmail(),
            ),
            'account' => array(
                'accountNumber' => $account->getAccountNumber(),
            ),
            'broker' => array(
                'name' => $broker->getName(),
                'ibCode' => $broker->getIbCode(),
            ),
        );

        $message = new EmailMessage($subjectLine, $template, $data);
        $message->setEmail($email);
        $message->setReplyTo('accounts@forexcashback.com');
        $message->setUser($user);

        // TODO - Add Reply To

        return $message;
    }
}
