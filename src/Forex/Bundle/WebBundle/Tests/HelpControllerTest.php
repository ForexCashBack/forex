<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

class HelpControllerTest extends WebTestCase
{
    public function testFaq()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/faq');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testGettingStarted()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/getting-started');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testHowToChooseABroker()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/how-to-choose-a-broker');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testResidualIncode()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/residual-income');

        $this->assertResponseSuccess($client->getResponse());
    }

    public function testEarningPotential()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/help/earning-potential');

        $this->assertResponseSuccess($client->getResponse());
    }
}
