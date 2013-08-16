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
        $afbfx = new Broker();
        $afbfx->setName('AFBFX');
        $afbfx->setSlug('afbfx');
        $afbfx->setCompanyName('AFB FX LTD');
        $afbfx->setReferralLink('https://www.afbfx.com/en/reg2/chooseAccount1?ref_id=1275');
        $afbfx->setBasePercentage(0.8);
        $afbfx->setMinDeposit(100);
        $afbfx->setMaxLeverage(500);
        $afbfx->setWebsite('http://www.afbfx.com/?ref_id=1275');
        $afbfx->setSpreadLink('http://www.afbfx.com/en/markets.html?ref_id=1275');
        $afbfx->setYearFounded(2011);
        $afbfx->setUsClients(true);
        $afbfx->setRate('0.9 pips/rount turn');
        $afbfx->setHighlight('99% Automated Execution; Free research and analysis; Advanced trading tools.');
        $afbfx->setRectangleImagePath('/uploads/brokers/afbfx_rect.png');
        $manager->persist($afbfx);

        $fxpro = new Broker();
        $fxpro->setName('FxPro');
        $fxpro->setSlug('fxpro');
        $fxpro->setCompanyName('FxPro Financial Services Ltd');
        $fxpro->setReferralLink('https://direct.fxpro.com/ib/en/usd/330474');
        $fxpro->setBasePercentage(0.8);
        $fxpro->setMinDeposit(50);
        $fxpro->setMaxLeverage(500);
        $fxpro->setWebsite('http://www.fxpro.com');
        $fxpro->setSpreadLink('http://www.fxpro.com');
        $fxpro->setYearFounded(2008);
        $fxpro->setUsClients(true);
        $fxpro->setRate('1.5 pips/round turn');
        $fxpro->setHighlight('Hold accounts in CHF, EUR, GBP, JPY or USD. Tight spreads. 8 Platforms. FSA, ASIC, and CYSEC regulated.');
        $fxpro->setRectangleImagePath('/uploads/brokers/fxpro_rect.png');
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

        $this->addReference('broker.afbfx', $afbfx);
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
