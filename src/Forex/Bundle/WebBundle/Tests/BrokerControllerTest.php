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
        $broker = $this->createBroker();

        $this->getClient()->request('GET', sprintf('/en/broker/broker/%s', $broker->getSlug()));
        $this->assertResponseSuccess($this->getResponse());
    }
}
