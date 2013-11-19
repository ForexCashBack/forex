<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class DefaultControllerTest extends WebTestCase
{
    public function testLoggedOutHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testContactForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/contact');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testReferralProgram()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/referral-program');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testPromotions()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/promotions');

        $this->assertResponseSuccess($client->getResponse());
    }
}
