<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     * @Template
     */
    public function homepageAction()
    {
        return array();
    }

    /**
     * @Route("/hello/{name}")
     * @Template
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/faq", name="faq")
     * @Template
     */
    public function faqAction()
    {
        return array();
    }

    /**
     * @Route("/contact", name="contact")
     * @Template
     */
    public function contactAction()
    {
        $form = $this->createContactForm();

        return array(
            'contactForm' => $form->createView(),
        );
    }

    /**
     * @Route("/referral-program", name="referral-program")
     * @Template
     */
    public function referralAction()
    {
        return array();
    }

    /**
     * @Route("/payment-methods", name="payment-methods")
     * @Template("ForexWebBundle:Default:payment-methods.html.twig")
     */
    public function paymentMethodsAction()
    {
        return array();
    }

    /**
     * @Route("/promotions", name="promotions")
     * @Template
     */
    public function promotionsAction()
    {
        $promotions = $this->getRepository('ForexCoreBundle:Promotion')->findActive();

        return array(
            'promotions' => $promotions,
        );
    }
}
