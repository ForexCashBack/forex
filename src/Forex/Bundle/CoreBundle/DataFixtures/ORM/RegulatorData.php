<?php

namespace Forex\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forex\Bundle\CoreBundle\Entity\Regulator;
use Forex\Bundle\CoreBundle\Entity\Regulation;

class RegulatorData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $cysec = new Regulator();
        $cysec->setAbbr('CYSEC');
        $cysec->setName('Cyprus Securities and Exchange Commission');
        $cysec->setUrl('http://www.cysec.gov.cy/licence_members_1_en.aspx');
        $manager->persist($cysec);

        $asic = new Regulator();
        $asic->setAbbr('ASIC');
        $asic->setName('Australian Securities & Investments Commission');
        $asic->setUrl('http://www.asic.gov.au/');
        $manager->persist($asic);

        $fsa = new Regulator();
        $fsa->setAbbr('FSA');
        $fsa->setName('Financial Services Authority');
        $fsa->setUrl('http://www.fsa.gov.uk/');
        $manager->persist($fsa);

        $fma = new Regulator();
        $fma->setAbbr('FMA');
        $fma->setName('Financial Markets Authority');
        $fma->setUrl('http://www.fma.govt.nz/laws-we-enforce/registers/list-of-authorised-futures-dealers/');
        $manager->persist($fma);

        // Create the broker regulations

        // Test Broker
        $testCysec = new Regulation();
        $testCysec->setBroker($this->getReference('broker.test'));
        $testCysec->setRegulator($cysec);
        $manager->persist($testCysec);

        // FxPro
        $fxproCysec = new Regulation();
        $fxproCysec->setBroker($this->getReference('broker.fxpro'));
        $fxproCysec->setRegulator($cysec);
        $manager->persist($fxproCysec);

        $fxproAsic = new Regulation();
        $fxproAsic->setBroker($this->getReference('broker.fxpro'));
        $fxproAsic->setRegulator($asic);
        $manager->persist($fxproAsic);

        $fxproFsa = new Regulation();
        $fxproFsa->setBroker($this->getReference('broker.fxpro'));
        $fxproFsa->setRegulator($fsa);
        $manager->persist($fxproFsa);

        // Excel
        $excelCysec = new Regulation();
        $excelCysec->setBroker($this->getReference('broker.excel'));
        $excelCysec->setRegulator($cysec);
        $manager->persist($excelCysec);

        $excelAsic = new Regulation();
        $excelAsic->setBroker($this->getReference('broker.excel'));
        $excelAsic->setRegulator($asic);
        $manager->persist($excelAsic);

        $excelFsa = new Regulation();
        $excelFsa->setBroker($this->getReference('broker.excel'));
        $excelFsa->setRegulator($fsa);
        $manager->persist($excelFsa);

        // Add some regulations

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200;
    }
}
