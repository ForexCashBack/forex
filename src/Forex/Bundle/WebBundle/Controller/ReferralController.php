<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/referral")
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
