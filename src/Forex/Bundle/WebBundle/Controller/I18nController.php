<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class I18nController extends CoreController
{
    /**
     * @Route("/", name="_intl")
     */
    public function paymentMethodsAction()
    {
        //TODO - "Guess" the incoming language
        return $this->redirect($this->generateUrl('homepage', array(
            '_locale' => 'en',
        )));
    }
}
