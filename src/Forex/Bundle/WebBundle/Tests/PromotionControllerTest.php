<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class PromotionControllerTest extends WebTestCase
{
    protected function tearDown()
    {
        $this->truncateTables(array('promotions', 'brokers', 'broker_account_types'));
    }

    public function testBrokerList()
    {
        $broker = $this->createBroker();
        $promotion = $this->createPromotion($broker);

        $this->getEntityManager()->flush();

        $this->getClient()->request('GET', sprintf('/en/promotion/%s', $promotion->getSlug()));
        $this->assertResponseSuccess($this->getResponse());
    }
}
