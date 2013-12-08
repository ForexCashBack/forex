<?php

namespace Forex\Bundle\EmailBundle\Mailer;

use Forex\Bundle\EmailBundle\Email\EmailManager;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @DI\Service("forex.mailer.user_mailer")
 */
class ForexUserMailer implements MailerInterface
{
    protected $emailManager;
    protected $router;

    /**
     * @DI\InjectParams({
     *      "emailManager" = @DI\Inject("forex.email_manager"),
     *      "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(EmailManager $emailManager, UrlGeneratorInterface $router)
    {
        $this->emailManager = $emailManager;
        $this->router = $router;
    }

    /**
     * Send an email to a user to confirm the account creation
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);

        $data = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->emailManager->sendToUser($user, 'Confirm Your Account', 'Account:Registration\confirmation', $data);
    }

    /**
     * Send an email to a user to confirm the password reset
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);

        $data = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->emailManager->sendToUser($user, 'Password Reset', 'Account:Resetting\password_reset', $data);
    }
}
