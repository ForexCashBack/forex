<?php

namespace Forex\Bundle\WebBundle\Controller\Account;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/account/{_locale}/referral", defaults={"_locale" = "en"}, schemes={"https"})
 */
class ReferralController extends CoreController
{
    /**
     * @Route("/account", name="referral_home")
     * @Template
     */
    public function homeAction()
    {
        $user = $this->getUser();

        return array(
            'user' => $user,
        );
    }
}
