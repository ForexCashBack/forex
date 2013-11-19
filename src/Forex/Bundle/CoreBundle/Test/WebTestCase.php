<?php

namespace Forex\Bundle\CoreBundle\Test;

use Faker\Factory;
use Forex\Bundle\CoreBundle\Test\Constraint\ResponseRedirect;
use Forex\Bundle\CoreBundle\Test\Constraint\ResponseSuccess;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\BrokerAccountType;
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

    public static function assertResponseRedirect(Response $response, $message = '')
    {
        self::assertThat($response, new ResponseRedirect(), $message);
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

    protected function getConnection()
    {
        return $this->getEntityManager()->getConnection();
    }

    protected function truncateTables(array $tables = array())
    {
        $conn = $this->getConnection();
        foreach ($tables as $table) {
            $conn->executeQuery(sprintf('TRUNCATE TABLE %s CASCADE', $table));
        }
    }

    protected function createBroker()
    {
        $broker = new Broker();
        $broker->setSlug(uniqid());
        $broker->setName($this->faker->word());
        $broker->setBasePercentage($this->getRandomPercentage());
        $broker->setCompanyName($this->faker->word(2));
        $broker->setWebsite($this->faker->url());
        $broker->setYearFounded(rand(2000, 2013));
        $broker->setReferralLink($this->faker->url());
        $broker->setHighlight($this->faker->paragraph());
        $broker->setSpreadLink($this->faker->url());
        $broker->setUsClients((bool) rand(0, 1));
        $broker->setRank(rand(0, 100));
        $broker->setActive(true);

        $brokerAccountType = $this->createBrokerAccountType($broker);

        $this->getEntityManager()->persist($broker);

        return $broker;
    }

    protected function createBrokerAccountType(Broker $broker)
    {
        $brokerAccountType = new BrokerAccountType();
        $brokerAccountType->setName($this->faker->word());
        $brokerAccountType->setRank(rand(1, 5));
        $brokerAccountType->setBasePercentage($this->getRandomPercentage());
        $brokerAccountType->setMinDeposit(rand(0, 5000));
        $brokerAccountType->setMaxLeverage(rand(100, 1000));

        $brokerAccountType->setBroker($broker);
        $broker->addAccountType($brokerAccountType);

        $this->getEntityManager()->persist($brokerAccountType);

        return $brokerAccountType;
    }

    private function getRandomPercentage()
    {
        return (float) mt_rand() / mt_getrandmax();
    }
}
