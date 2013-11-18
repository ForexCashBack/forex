<?php

namespace Forex\Bundle\CoreBundle\Test;

use Faker\Factory;
use Forex\Bundle\CoreBundle\Test\Constraint\ResponseSuccess;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class WebTestCase extends BaseWebTestCase
{
    protected $client;
    protected $faker;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->faker = Factory::create();
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
        $broker->setSlug(uniqid());
        $broker->setName($this->faker->word());
        $broker->setBasePercentage(rand(0, 100));
        $broker->setCompanyName($this->faker->word(2));
        $broker->setWebsite($this->faker->url());
        $broker->setYearFounded(rand(2000, 2013));
        $broker->setReferralLink($this->faker->url());
        $broker->setHighlight($this->faker->paragraph());
        $broker->setSpreadLink($this->faker->url());
        $broker->setUsClients((bool) rand(0, 1));
        $broker->setRank(rand(0, 100));
        $broker->setActive(true);

        $this->getEntityManager()->persist($broker);
        $this->getEntityManager()->flush();

        return $broker;
    }
}
