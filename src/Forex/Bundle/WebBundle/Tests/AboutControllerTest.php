<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    public function testPaymentMethods()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/about/payment-methods');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testWhoWeAre()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/about/who-we-are');

        $this->assertResponseSuccess($client->getResponse());
    }
}
