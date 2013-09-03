<?php

namespace Forex\Bundle\WebBundle\Controller\Account;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/account/{_locale}/referral", defaults={"_locale" = "en"})
 */
class ReferralController extends BaseController
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
