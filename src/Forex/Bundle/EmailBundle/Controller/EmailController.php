<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailController extends BaseController
{
    protected function findLink($id)
    {
        $link = $this->getRepository('ForexEmailBundle:EmailLink')->find($id);

        if (!$link) {
            throw new NotFoundHttpException(sprintf('Link with id %s not found', $id));
        }

        return $link;
    }

    protected function findMessage($id)
    {
        $message = $this->getRepository('ForexEmailBundle:EmailMessage')->find($id);

        if (!$message) {
            throw new NotFoundHttpException(sprintf('Message with id %s not found', $id));
        }

        return $message;
    }
}
