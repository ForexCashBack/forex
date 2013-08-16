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

        $fca = new Regulator();
        $fca->setAbbr('FCA');
        $fca->setName('Financial Conduct Authority');
        $fca->setUrl('http://www.fca.org.uk/');
        $manager->persist($fca);

        $fma = new Regulator();
        $fma->setAbbr('FMA');
        $fma->setName('Financial Markets Authority');
        $fma->setUrl('http://www.fma.govt.nz/laws-we-enforce/registers/list-of-authorised-futures-dealers/');
        $manager->persist($fma);

        $mifid = new Regulator();
        $mifid->setAbbr('MiFID');
        $mifid->setName('Markets in Financial Instruments Directive');
        $mifid->setUrl('http://ec.europa.eu/internal_market/securities/isd/mifid/index_en.htm');
        $manager->persist($mifid);

        $bafin = new Regulator();
        $bafin->setAbbr('BaFin');
        $bafin->setName('Federal Financial Supervisory Authority');
        $bafin->setUrl('http://www.bafin.de/EN/Homepage/homepage_node.html');
        $manager->persist($bafin);

        // Create the broker regulations

        // AFBFX
        $afbfxCysec = new Regulation();
        $afbfxCysec->setBroker($this->getReference('broker.afbfx'));
        $afbfxCysec->setRegulator($cysec);
        $manager->persist($afbfxCysec);

        $afbfxFCA = new Regulation();
        $afbfxFCA->setBroker($this->getReference('broker.afbfx'));
        $afbfxFCA->setRegulator($fca);
        $manager->persist($afbfxFCA);

        $afbfxMIFID = new Regulation();
        $afbfxMIFID->setBroker($this->getReference('broker.afbfx'));
        $afbfxMIFID->setRegulator($mifid);
        $manager->persist($afbfxMIFID);

        $afbfxBaFin = new Regulation();
        $afbfxBaFin->setBroker($this->getReference('broker.afbfx'));
        $afbfxBaFin->setRegulator($bafin);
        $manager->persist($afbfxBaFin);

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
