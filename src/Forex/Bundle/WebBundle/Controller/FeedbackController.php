<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/feedback", defaults={"_locale" = "en"})
 */
class FeedbackController extends CoreController
{
    /**
     * @Route("/suggestion", name="feedback_suggestion")
     * @Template
     */
    public function brokerSuggestionAction()
    {
        $form = $this->createBrokerSuggestionForm($this->getUser());

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bind($this->getRequest());
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

    /**
     * @Route("/complaint", name="feedback_complaint")
     * @Template
     */
    public function complaintAction()
    {
        $form = $this->createComplaintForm($this->getUser());

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $complaint = $form->getData();

                $this->getEntityManager()->persist($complaint);
                $this->getEntityManager()->flush();

                $message = $this->getTranslatedKey('feedback.complaint_success');
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
