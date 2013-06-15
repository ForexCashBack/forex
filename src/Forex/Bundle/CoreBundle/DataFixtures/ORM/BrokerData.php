<?php

namespace Forex\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forex\Bundle\CoreBundle\Entity\Broker;

class BrokerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $test = new Broker();
        $test->setName('Test Broker');
        $test->setSlug('test-broker');
        $test->setCompanyName('Test Broker, LLC');
        $test->setReferralLink('http://www.test.com?referral_link=test');
        $test->setBasePercentage(0.8);
        $test->setMinDeposit(50);
        $test->setMaxLeverage(500);
        $test->setWebsite('http://www.test.com');
        $test->setSpreadLink('http://www.test.com');
        $test->setYearFounded(1998);
        $test->setUsClients(false);
        $test->setRate('$2/round turn lot');
        $test->setHighlight('This is the test broker, it is great becase it is our first broker');
        $manager->persist($test);

        $fxpro = new Broker();
        $fxpro->setName('FxPro');
        $fxpro->setSlug('fxpro');
        $fxpro->setCompanyName('FxPro Financial Services Ltd');
        $fxpro->setReferralLink('http://www.fxpro.com?referral_link=test');
        $fxpro->setBasePercentage(0.8);
        $fxpro->setMinDeposit(50);
        $fxpro->setMaxLeverage(500);
        $fxpro->setWebsite('http://www.fxpro.com');
        $fxpro->setSpreadLink('http://www.fxpro.com');
        $fxpro->setYearFounded(2008);
        $fxpro->setUsClients(true);
        $fxpro->setRate('1.5 pips/round turn');
        $fxpro->setHighlight('Hold accounts in CHF, EUR, GBP, JPY or USD. Tight spreads. 8 Platforms. FSA, ASIC, and CYSEC regulated.');
        $manager->persist($fxpro);

        $excel = new Broker();
        $excel->setName('Excel Markets');
        $excel->setSlug('excel-markets');
        $excel->setCompanyName('Global Brokers NZ Ltd.');
        $excel->setReferralLink('https://www.excelmarkets.com?referral_link=test');
        $excel->setBasePercentage(0.8);
        $excel->setMinDeposit(200);
        $excel->setMaxLeverage(400);
        $excel->setWebsite('https://www.excelmarkets.com/');
        $excel->setSpreadLink('https://www.excelmarkets.com/');
        $excel->setYearFounded(2002);
        $excel->setUsClients(false);
        $excel->setRate('.6 pips/round turn');
        $excel->setHighlight('Tight spreads with NO Deposit Fees. ECN/STP. MT4. 400:1 leverage. Micro lots.');
        $manager->persist($excel);

        $manager->flush();

        $this->addReference('broker.test', $test);
        $this->addReference('broker.fxpro', $fxpro);
        $this->addReference('broker.excel', $excel);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }
}
