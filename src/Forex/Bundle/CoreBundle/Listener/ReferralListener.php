<?php

namespace Forex\Bundle\CoreBundle\Listener;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\CoreBundle\Referral\ReferralManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @DI\Service("forex.listener.referral_listener")
 */
class ReferralListener
{
    const REFERRAL_COOKIE  = 'forex_referrer';
    const REFERRAL_PARAM   = 'rid';
    const REFERRAL_SESSION = 'forex.referrer';

    protected $securityContext;
    protected $em;
    protected $session;
    protected $referralManager;

    /**
     * @DI\InjectParams({
     *      "securityContext" = @DI\Inject("security.context"),
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "session" = @DI\Inject("session"),
     *      "referralManager" = @DI\Inject("forex.referrer.referral_manager")
     * })
     */
    public function __construct(SecurityContext $securityContext, EntityManager $em, Session $session, ReferralManager $referralManager)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
        $this->session = $session;
        $this->referralManager = $referralManager;
    }

    /**
     * @DI\Observe("kernel.request", priority = 255)
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Only process the master request
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        // Only process non-logged-in users
        if ($token = $this->securityContext->getToken()) {
            $user = $token->getUser();
            if ($user instanceof User) {
                return;
            }
        }

        // Check to see if there is a referral id in the request
        $request = $event->getRequest();
        $referralId = $request->query->get(self::REFERRAL_PARAM);
        if (!$referralId) {
            return;
        }

        // Store the referral id in the session, so it can be consumed later
        $this->session->set(self::REFERRAL_SESSION, $referralId);
    }

    /**
     * @DI\Observe("kernel.response", priority = 255)
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        // If it ain't in the session, we don't care
        if (!($referralId = $this->session->get(self::REFERRAL_SESSION))) {
            return;
        }

        // If there is a cookie already set, then do nothing
        if ($event->getRequest()->cookies->has(self::REFERRAL_COOKIE)) {
            return;
        }

        $event->getResponse()->headers->setCookie(new Cookie(self::REFERRAL_COOKIE, $referralId));
    }

    /**
     * @DI\Observe("fos_user.registration.completed")
     */
    public function addReferrerToUser(FilterUserResponseEvent $event)
    {
        $request = $event->getRequest();

        // No cookie, no nookie
        if (!$referralId = $request->cookies->get(self::REFERRAL_COOKIE)) {
            return;
        }

        // Find the referrer
        $referrer = $this->em->getRepository('ForexCoreBundle:User')->findOneById($referralId);

        if (!$referrer) {
            return;
        }

        $user = $event->getUser();

        $this->referralManager->addReferrerToUser($user, $referrer);
        $this->em->flush();
    }
}
