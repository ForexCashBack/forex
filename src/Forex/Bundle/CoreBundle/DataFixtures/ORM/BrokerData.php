<?php

namespace Forex\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\BrokerAccountType;

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
        $afbfx->setWebsite('http://www.afbfx.com/?ref_id=1275');
        $afbfx->setSpreadLink('http://www.afbfx.com/en/markets.html?ref_id=1275');
        $afbfx->setYearFounded(2011);
        $afbfx->setUsClients(true);
        $afbfx->setRate('0.9 pips/rount turn');
        $afbfx->setHighlight('99% Automated Execution; Free research and analysis; Advanced trading tools.');
        $afbfx->setRectangleImagePath('/uploads/brokers/afbfx_rect.png');
        $afbfx->setRank(100);
        $afbfx->setActive(true);
        $manager->persist($afbfx);

        $afbfxMicro = new BrokerAccountType();
        $afbfxMicro->setName('micro');
        $afbfxMicro->setBroker($afbfx);
        $afbfxMicro->setBasePercentage(0.8);
        $afbfxMicro->setMinDeposit(100);
        $afbfxMicro->setMaxLeverage(500);
        $manager->persist($afbfxMicro);

        $afbfxStandard = new BrokerAccountType();
        $afbfxStandard->setName('Standard');
        $afbfxStandard->setBroker($afbfx);
        $afbfxStandard->setBasePercentage(0.8);
        $afbfxStandard->setMinDeposit(1000);
        $afbfxStandard->setMaxLeverage(300);
        $manager->persist($afbfxStandard);

        $fxpro = new Broker();
        $fxpro->setName('FxPro');
        $fxpro->setSlug('fxpro');
        $fxpro->setCompanyName('FxPro Financial Services Ltd');
        $fxpro->setReferralLink('https://direct.fxpro.com/ib/en/usd/330474');
        $fxpro->setBasePercentage(0.8);
        $fxpro->setWebsite('http://www.fxpro.com');
        $fxpro->setSpreadLink('http://www.fxpro.com');
        $fxpro->setYearFounded(2008);
        $fxpro->setUsClients(true);
        $fxpro->setRate('1.5 pips/round turn');
        $fxpro->setHighlight('Hold accounts in CHF, EUR, GBP, JPY or USD. Tight spreads. 8 Platforms. FSA, ASIC, and CYSEC regulated.');
        $fxpro->setRectangleImagePath('/uploads/brokers/fxpro_rect.png');
        $fxpro->setRank(200);
        $fxpro->setActive(true);
        $manager->persist($fxpro);

        $fxproMicro = new BrokerAccountType();
        $fxproMicro->setName('micro');
        $fxproMicro->setBroker($fxpro);
        $fxproMicro->setBasePercentage(0.8);
        $fxproMicro->setMinDeposit(100);
        $fxproMicro->setMaxLeverage(500);
        $manager->persist($fxproMicro);

        $fxcc = new Broker();
        $fxcc->setName('FXCC');
        $fxcc->setSlug('fxcc');
        $fxcc->setCompanyName('FX Central Clearing Ltd');
        $fxcc->setReferralLink('http://www.fxcc.com/?fx=i-1480-S00C00');
        $fxcc->setBasePercentage(0.8);
        $fxcc->setWebsite('http://www.fxcc.com/');
        $fxcc->setSpreadLink('http://www.fxcc.com/spreads');
        $fxcc->setYearFounded(2010);
        $fxcc->setUsClients(true);
        $fxcc->setRate('dynamic based on trading');
        $fxcc->setHighlight('FXCC’s business model (ECN/STP) offers complete anonymity, full transparency, advanced execution, direct and competitive market prices and spreads. This creates a trading environment with no re-quotes and no conflict of interests or bias against any trader or forex trading system including automated systems and forex scalping.');
        $fxcc->setRectangleImagePath('/uploads/brokers/fxcc_rect.gif');
        $fxcc->setRank(300);
        $fxcc->setActive(true);
        $manager->persist($fxcc);

        $fxccMicro = new BrokerAccountType();
        $fxccMicro->setName('micro');
        $fxccMicro->setBroker($fxcc);
        $fxccMicro->setBasePercentage(0.8);
        $fxccMicro->setMinDeposit(100);
        $fxccMicro->setMaxLeverage(500);
        $manager->persist($fxccMicro);

        $manager->flush();

        $this->addReference('broker.afbfx', $afbfx);
        $this->addReference('broker.fxpro', $fxpro);
        $this->addReference('broker.fxcc', $fxcc);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }
}
