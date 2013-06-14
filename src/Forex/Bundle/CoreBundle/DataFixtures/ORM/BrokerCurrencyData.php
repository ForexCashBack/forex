<?php

namespace Forex\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forex\Bundle\CoreBundle\Entity\Broker;

class BrokerCurrencyData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // FxPro
        $this->getReference('broker.fxpro')->addEquityHoldingCurriency($this->getReference('currency.usd'));
        $this->getReference('broker.fxpro')->addEquityHoldingCurriency($this->getReference('currency.gbp'));
        $this->getReference('broker.fxpro')->addEquityHoldingCurriency($this->getReference('currency.jmd'));

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 101;
    }
}
