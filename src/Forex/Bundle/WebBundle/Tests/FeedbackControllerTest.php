<?php

namespace Forex\Bundle\WebBundle\Tests;

use Forex\Bundle\CoreBundle\Test\WebTestCase;

/**
 * @group functional
 */
class FeedbackControllerTest extends WebTestCase
{
    protected function tearDown()
    {
        $this->truncateTables(array('brokers', 'broker_account_types', 'broker_suggestions', 'complaints'));
    }

    public function testBrokerSuggestion()
    {
        $this->client->request('GET', '/en/feedback/suggestion');

        $this->assertResponseSuccess($this->client->getResponse());
    }

    public function testCreateBrokerSuggestion()
    {
        $brokerSuggestions = $this->getBrokerSuggestions();
        $this->assertEquals(0, count($brokerSuggestions));

        $form = $this->client->request('GET', '/en/feedback/suggestion')
            ->filter('form[action$="/en/feedback/suggestion"] button')
            ->form();

        $suggestionText = $this->faker->word(5);
        $form['broker_suggestion[suggestion]'] = $suggestionText;

        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect('/en/'));

        $brokerSuggestions = $this->getBrokerSuggestions();
        $this->assertEquals(1, count($brokerSuggestions));
    }

    public function testComplaint()
    {
        $this->client->request('GET', '/en/feedback/complaint');

        $this->assertResponseSuccess($this->client->getResponse());
    }

    public function testCreateComplaintLoggedIn()
    {
        $complaints = $this->getComplaints();
        $this->assertEquals(0, count($complaints));

        $broker = $this->createBroker();

        $email = $this->faker->email();
        $password = $this->faker->word();
        $user = $this->createUser($email, $password);
        $this->getEntityManager()->flush();

        $this->authenticateClient($user);

        $this->client->request('GET', '/en/feedback/complaint');
        $form = $this->client->request('GET', '/en/feedback/complaint')
            ->filter('form[action$="/en/feedback/complaint"] button')
            ->form();

        $complaintText = $this->faker->word(5);
        $form['broker_complaint[broker]'] = $broker->getId();
        $form['broker_complaint[complaint]'] = $complaintText;

        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect('/en/'));

        $complaints = $this->getComplaints();
        $this->assertEquals(1, count($complaints));
    }

    protected function getBrokerSuggestions()
    {
        return $this->getEntityManager()->getRepository('ForexCoreBundle:BrokerSuggestion')->findAll();
    }

    protected function getComplaints()
    {
        return $this->getEntityManager()->getRepository('ForexCoreBundle:Complaint')->findAll();
    }
}
