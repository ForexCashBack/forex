<?php

namespace Forex\Bundle\CoreBundle\Payment;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Entity\Payment;
use Forex\Bundle\CoreBundle\Entity\PartialPayout;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.payment_manager")
 */
class PaymentManager
{
    protected $em;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager")
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createPayment(Payment $payment)
    {
        // Create the associated partial payout
        $partialPayout = new PartialPayout($payment);

        $amount = $payment->getAmount() * $payment->getAccount()->getPayoutPercentage();
        $partialPayout->setAmount($amount);

        $this->em->persist($partialPayout);
    }
}
