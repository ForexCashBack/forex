<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class LegalControllerTest extends WebTestCase
{
    public function testPrivacyPolicy()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/legal/privacy-policy');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testRegistrationAgreement()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/legal/registration-agreement');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testRiskDisclosure()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/legal/risk-disclosure-statment');

        $this->assertResponseSuccess($client->getResponse());
    }
}
