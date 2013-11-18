<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class HelpControllerTest extends WebTestCase
{
    public function testHowToChooseABroker()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/how-to-choose-a-broker');

        $this->assertResponseSuccess($client->getResponse());
    }
}
