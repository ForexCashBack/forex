<?php

namespace Forex\Bundle\MandrillBundle\Email;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * Really basic proxy object for interacting with the mandrill service
 *
 * @DI\Service("forex.mandrill.sender")
 */
class Sender
{
    protected $mandrill;

    /**
     * @DI\InjectParams({
     *      "mandrill" = @DI\Inject("mandrill.client")
     * })
     */
    public function __construct(\Mandrill $mandrill)
    {
        $this->mandrill = $mandrill;
    }

    public function send(array $data)
    {
        $this->mandrill->messages->send($data, true);
    }
}
