<?php

namespace Forex\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forex\Bundle\CoreBundle\Entity\DepositMethod;

class DepositMethodData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paypal = new DepositMethod();
        $paypal->setAbbr('paypal');
        $paypal->setName('PayPal');
        $manager->persist($paypal);

        $bankwire = new DepositMethod();
        $bankwire->setAbbr('bankwire');
        $bankwire->setName('bankwire');
        $manager->persist($bankwire);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 102;
    }
}
