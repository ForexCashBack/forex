<?php

namespace Forex\Bundle\CoreBundle\Payout;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\CoreBundle\Entity\Payout;
use Forex\Bundle\CoreBundle\Entity\PartialPayout;
use Forex\Bundle\CoreBundle\Entity\User;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("forex.payout_manager")
 */
class PayoutManager
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

    public function resolvePartialPayouts(Payout $payout)
    {
        $user = $payout->getUser();

        // Get all of the partial payouts that are yet to be resolved for this user
        $unresolvedPartialPayouts = $this->getUnresolvedPartialPayouts($user);

        $payoutAmount = $payout->getAmount();

        foreach ($unresolvedPartialPayouts as $partialPayout) {
            $partialPayoutAmount = $partialPayout->getAmount();
            var_dump($payoutAmount, '~', $partialPayoutAmount);
            if ($partialPayoutAmount < $payoutAmount) {
                var_dump('yep', $payoutAmount);
                $partialPayout->setPayout($payout);
                $payoutAmount -= $partialPayoutAmount;
            } else {
                //break;
            }
        }
        die('vvv');
    }

    private function getUnresolvedPartialPayouts(User $user)
    {
        return $this->em->getRepository('ForexCoreBundle:PartialPayout')
            ->getUnresolvedPartialPayouts($user);
    }
}
