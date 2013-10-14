<?php

namespace Forex\Bundle\EmailBundle\Email;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;

interface EmailSenderInterface
{
    public function send(EmailMessage $message);
}
