<?php

namespace Forex\Bundle\EmailBundle\Controller;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/_preview")
 */
class PreviewController extends BaseController
{
    /**
     * @Route("/test/{type}")
     */
    public function testAction($type)
    {
        $message = new EmailMessage('Test', sprintf('Test:test.%s', $type));
        $message->setId(-1);

        $template = sprintf('ForexEmailBundle:Test:test.%s.twig', $type);
        return $this->render($template, array(
            '_message' => $message,
        ));
    }

    /**
     * @Route("/{id}/{type}")
     */
    public function viewAction($id, $type)
    {
        $message = $this->findEmailMessage($id);

        $template = sprintf('ForexEmailBundle:%s.%s.twig', $message->getTemplate(), $type);
        return $this->render($template, array_merge($message->getData(), array(
            '_message' => $message,
        )));
    }
}
