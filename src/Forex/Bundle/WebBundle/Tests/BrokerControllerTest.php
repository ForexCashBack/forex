<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class BrokerControllerTest extends WebTestCase
{
    protected function tearDown()
    {
        $this->truncateTables(array('broker_account_types', 'brokers'));
    }

    public function testBrokerList()
    {
        $broker = $this->createBroker();
        $this->getEntityManager()->flush();

        $this->getClient()->request('GET', '/en/broker/list');
        $this->assertResponseSuccess($this->getResponse());
    }

    public function testBrokerView()
    {
        $broker = $this->createBroker();
        $this->getEntityManager()->flush();

        $this->getClient()->request('GET', sprintf('/en/broker/broker/%s', $broker->getSlug()));
        $this->assertResponseSuccess($this->getResponse());
    }
}
