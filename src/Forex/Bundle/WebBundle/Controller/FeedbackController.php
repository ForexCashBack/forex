<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/feedback", defaults={"_locale" = "en"})
 */
class FeedbackController extends BaseController
{
    /**
     * @Route("/suggestion", name="feedback_suggestion")
     * @Template
     */
    public function brokerSuggestionAction()
    {
        $form = $this->createBrokerSuggestionForm($this->getUser());

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $suggestion = $form->getData();

                $this->getEntityManager()->persist($suggestion);
                $this->getEntityManager()->flush();

                $message = $this->getTranslatedKey('feedback.suggestion_success');
                $this->addMessage('success', $message);

            }

            return $this->redirect($this->generateUrl('homepage', array(
                '_locale' => $this->getLocale(),
            )));
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
