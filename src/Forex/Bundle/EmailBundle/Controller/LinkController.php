<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/link")
 */
class LinkController extends EmailController
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
}
