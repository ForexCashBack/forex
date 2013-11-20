<?php

namespace Forex\Bundle\CoreBundle\Test\Constraint;

use Symfony\Component\HttpFoundation\Response;

class ResponseRedirect extends \PHPUnit_Framework_Constraint
{
    public function toString()
    {
        return sprintf('HTTP: 3xx Redirection');
    }

    public function evaluate($response, $description = '', $returnResult = false)
    {
        if (!$response instanceof Response) {
            throw new \InvalidArgumentException('ResponseRedirect::evaluate() expects a Response object.');
        }

        $statusCode = $response->getStatusCode();

        $success = $statusCode >= 300 && $statusCode <= 308;

        if ($returnResult || !version_compare(\PHPUnit_Runner_Version::id(), '3.6.0RC1', '>=')) {
            return $success;
        }

        if (!$success) {
            $this->fail($response, $description);
        }
    }
}
