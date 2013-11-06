<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Forex\Bundle\CoreBundle\Entity\Promotion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/promotion", defaults={"_locale" = "en"})
 */
class PromotionController extends CoreController
{
    /**
     * @Route("/{slug}", name="promotion_view")
     * @ParamConverter("promotion", class="ForexCoreBundle:Promotion", options={"slug" = "slug"})
     * @Template
     */
    public function viewAction(Promotion $promotion)
    {
        $user = $this->getUser();

        return array(
            'user' => $user,
            'promotion' => $promotion,
        );
    }
}
