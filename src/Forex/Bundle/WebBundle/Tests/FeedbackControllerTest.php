<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class FeedbackControllerTest extends WebTestCase
{
    public function testBrokerSuggestion()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/feedback/suggestion');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testComplaint()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/feedback/complaint');

        $this->assertResponseSuccess($client->getResponse());
    }
}
