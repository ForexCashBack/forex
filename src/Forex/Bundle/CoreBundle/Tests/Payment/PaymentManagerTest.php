<?php

namespace Forex\Bundle\CoreBundle\Tests\Payment;

use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\PartialPayout;
use Forex\Bundle\CoreBundle\Entity\Payment;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\CoreBundle\Payment\PaymentManager;

class PaymentManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $em;
    protected $paymentManager;

    protected function setUp()
    {
        $this->em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();

        $this->paymentManager = new PaymentManager($this->em);
    }

    public function testCreatePartialPayouts()
    {
        $user = new User();
        $referralUserLevel1 = new User();
        $referralUserLevel2 = new User();
        $referralUserLevel3 = new User();

        // Setup referral hierarchy
        $user->setReferrer($referralUserLevel1);
        $referralUserLevel1->setReferrer($referralUserLevel2);
        $referralUserLevel2->setReferrer($referralUserLevel3);

        // Setup the account
        $account = new Account();
        $account->setUser($user);
        $account->setPayoutPercentage(0.9);
        $account->setBroker(new Broker());

        // Setup payment
        $payment = new Payment();
        $payment->setAccount($account);
        $payment->setAmount(100);

        $this->paymentManager->createPartialPayouts($payment);

        $this->assertEquals(90, $user->getTotalPartialPayoutAmount());
        $this->assertEquals(9, $referralUserLevel1->getTotalPartialPayoutAmount());
        $this->assertEquals(5, $referralUserLevel2->getTotalPartialPayoutAmount());
        $this->assertEquals(1, $referralUserLevel3->getTotalPartialPayoutAmount());
    }

    /**
     * @dataProvider partialPayoutData
     */
    public function testCreatePartialPayout(Payment $payment, User $user, $amount, $description)
    {
        $partialPayout = new PartialPayout($payment);
        $partialPayout->setAmount($amount);
        $partialPayout->setUser($user);
        $partialPayout->setDescription($description);

        $this->em->expects($this->once())
            ->method('persist')
            ->with($partialPayout);

        $this->paymentManager->createPartialPayout($payment, $user, $amount, $description);
    }

    public function partialPayoutData()
    {
        $payment = new Payment();
        $user = new User();

        return array(
            array($payment, $user, 10, 'test'),
        );
    }
}
