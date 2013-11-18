<?php

namespace Forex\Bundle\CoreBundle\Test;

use Forex\Bundle\CoreBundle\Test\Constraint\ResponseSuccess;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class WebTestCase extends BaseWebTestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public static function assertResponseSuccess(Response $response, $message = '')
    {
        self::assertThat($response, new ResponseSuccess(), $message);
    }

    protected function getClient()
    {
        return $this->client;
    }

    protected function getResponse()
    {
        return $this->getClient()->getResponse();
    }

    protected function getContainer()
    {
        return $this->client->getContainer();
    }

    protected function getEntityManager()
    {
        return $this->getContainer()->get('doctrine.orm.default_entity_manager');
    }

    protected function createBroker()
    {
        $broker = new Broker();
        $this->getEntityManager()->persist($broker);
        $this->getEntityManager()->flush();

        return $broker;
    }
}
