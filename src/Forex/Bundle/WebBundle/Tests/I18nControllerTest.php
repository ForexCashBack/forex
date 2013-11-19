<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class I18nControllerTest extends WebTestCase
{
    public function testBrokerSuggestion()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseRedirect($client->getResponse());
        $this->assertTrue($client->getResponse()->isRedirect('/en/'));
    }
}
