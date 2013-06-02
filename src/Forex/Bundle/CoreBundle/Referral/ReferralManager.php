<?php

namespace Forex\Bundle\CoreBundle\Referral;

use Forex\Bundle\CoreBundle\Entity\User;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.referrer.referral_manager")
 */
class ReferralManager
{
    public function addReferrerToUser(User $user, User $referrer)
    {
        if (!$user->getReferrer()) {
            $user->setReferrer($referrer);
        }
    }
}
