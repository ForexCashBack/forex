<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class BrokerControllerTest extends WebTestCase
{
    public function testBrokerList()
    {
        $this->getClient()->request('GET', '/en/broker/list');
        $this->assertResponseSuccess($this->getResponse());
    }

    public function testBrokerView()
    {
        $this->getClient()->request('GET', '/en/about/who-we-are');
        $this->assertResponseSuccess($this->getResponse());
    }
}
