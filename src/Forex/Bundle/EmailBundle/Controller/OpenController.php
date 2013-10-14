<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/open")
 */
class OpenController extends EmailController
{
    /**
     * @Route("/{id}.png", name="email_open")
     */
    public function openAction($id)
    {
        $message = $this->findMessage($id);

        $this->getOpenManager()->registerOpen($message);
        $this->getEntityManager()->flush();

        $rootDir = $this->container->getParameter('kernel.root_dir');
        $data = readfile(sprintf('%s/%s', $rootDir, '../web/img/email/beacon.png'));
        $headers = array(
            'Content-Type' => 'image/png',
        );

        return new Response($data, 200, $headers);
    }
}
