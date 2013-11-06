<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController as CoreController;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;

class BaseController extends CoreController
{
    protected function findEmailMessage($id)
    {
        $message = $this->getRepository('ForexEmailBundle:EmailMessage')->find($id);

        return $message;
    }
}
