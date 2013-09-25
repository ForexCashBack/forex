<?php

namespace Forex\Bundle\CoreBundle\Payment;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Entity\Payment;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\CoreBundle\Entity\PartialPayout;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.payment_manager")
 */
class PaymentManager
{
    const REFERRAL_PERCENT_LEVEL_1 = 0.10;
    const REFERRAL_PERCENT_LEVEL_2 = 0.05;
    const REFERRAL_PERCENT_LEVEL_3 = 0.01;

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

    public function createPartialPayouts(Payment $payment)
    {
        $user = $payment->getAccount()->getUser();
        $baseAmount = $payment->getAmount() * $payment->getAccount()->getPayoutPercentage();

        // Check for referral payments
        if ($firstLevelReferrer = $user->getReferrer()) {
            // Payment for first level
            $amount = round($baseAmount * self::REFERRAL_PERCENT_LEVEL_1);
            $this->createPartialPayout($payment, $firstLevelReferrer, $amount);

            // Check for second level payment
            if ($secondLevelReferrer = $firstLevelReferrer->getReferrer()) {
                // Payment for second level
                $amount = round($baseAmount * self::REFERRAL_PERCENT_LEVEL_2);
                $this->createPartialPayout($payment, $secondLevelReferrer, $amount);

                // Check for the third level payment
                if ($thirdLevelReferrer = $secondLevelReferrer->getReferrer()) {
                    // Payment for the third level
                    $amount = round($baseAmount * self::REFERRAL_PERCENT_LEVEL_3);
                    $this->createPartialPayout($payment, $thirdLevelReferrer, $amount);
                }
            }
        }

        $this->createPartialPayout($payment, $user, $baseAmount);
    }

    public function createPartialPayout(Payment $payment, User $user, $amount, $description = '')
    {
        $partialPayout = new PartialPayout($payment);
        $partialPayout->setAmount($amount);
        $partialPayout->setUser($user);
        $partialPayout->setDescription($description);

        $user->addPartialPayout($partialPayout);

        $this->em->persist($partialPayout);

        return $partialPayout;
    }
}
