<?php

namespace Forex\Bundle\CoreBundle\Tests\Entity;

use Forex\Bundle\CoreBundle\Entity\PartialPayout;
use Forex\Bundle\CoreBundle\Entity\Payment;
use Forex\Bundle\CoreBundle\Entity\Payout;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\CoWebreBundle\Payment\PaymentManager;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCurrentPayoutBalance()
    {
        $user = new User();

        $payment1 = new Payment();
        $partialPayout1 = new PartialPayout($payment1);
        $partialPayout1->setAmount(100);
        $user->addPartialPayout($partialPayout1);

        $this->assertEquals(100, $user->getCurrentPayoutBalance());

        $payment2 = new Payment();
        $partialPayout2 = new PartialPayout($payment2);
        $partialPayout2->setAmount(200);
        $user->addPartialPayout($partialPayout2);

        $this->assertEquals(300, $user->getCurrentPayoutBalance());

        $payout1 = new Payout();
        $payout1->setAmount(150);
        $user->addPayout($payout1);

        $this->assertEquals(150, $user->getCurrentPayoutBalance());
    }
}
