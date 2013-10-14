<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/link")
 */
class LinkController extends BaseController
{
    /**
     * @Route("/{id}", name="email_link")
     */
    public function linkAction($id)
    {
        $link = $this->findLink($id);

        $this->getClickManager()->registerClick($link);
        $this->getEntityManager()->flush();

        return $this->redirect($link->getToUrl());
    }

    protected function findLink($id)
    {
        $link = $this->getRepository('ForexEmailBundle:EmailLink')->find($id);

        if (!$link) {
            throw new \NotFoundHttpException(sprintf('Link with id %s not found', $id));
        }

        return $link;
    }
}
