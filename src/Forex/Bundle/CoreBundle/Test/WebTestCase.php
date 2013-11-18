<?php

namespace Forex\Bundle\CoreBundle\Test;

use Forex\Bundle\CoreBundle\Test\Constraint\ResponseSuccess;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class WebTestCase extends BaseWebTestCase
{
    public static function assertResponseSuccess(Response $response, $message = '')
    {
        self::assertThat($response, new ResponseSuccess(), $message);
    }
}
