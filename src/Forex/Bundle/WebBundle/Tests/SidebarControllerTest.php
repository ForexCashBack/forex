<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class SidebarControllerTest extends WebTestCase
{
    protected function tearDown()
    {
        $this->truncateTables(array('brokers', 'broker_account_types'));
    }

    public function testBrokerRates()
    {
        $broker = $this->createBroker();
        $this->getEntityManager()->flush();

        $this->getClient()->request('GET', '_internal/sidebar/broker-rates');
        $this->assertResponseSuccess($this->getResponse());
    }
}
