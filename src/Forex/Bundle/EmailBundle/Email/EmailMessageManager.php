<?php

namespace Forex\Bundle\EmailBundle\Email;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\Serializer;

/**
 * @DI\Service("forex.email_message_manager")
 */
class EmailMessageManager
{
    protected $serializer;

    /**
     * @DI\InjectParams({
     *      "serializer" = @DI\Inject("jms_serializer"),
     * })
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Create an EmailMessage with serialized data
     *
     * @param string $subjectLine
     * @param string $template
     * @param array $data
     *
     * @return EmailMessageManager
     */
    public function createEmailMessage($subjectLine, $template, $data)
    {
        $serializedData = $this->serializer->serialize($data, 'json');

        $message = new EmailMessage($subjectLine, $template);
        $message->setJsonData($serializedData);

        return $message;
    }
}
