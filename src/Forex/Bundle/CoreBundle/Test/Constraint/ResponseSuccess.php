<?php

namespace Forex\Bundle\CoreBundle\Test\Constraint;

use Symfony\Component\HttpFoundation\Response;

class ResponseSuccess extends \PHPUnit_Framework_Constraint
{
    public function toString()
    {
        return sprintf('HTTP: Response 200');
    }

    public function evaluate($response, $description = '', $returnResult = false)
    {
        if (!$response instanceof Response) {
            throw new \InvalidArgumentException('ResponseSuccess::evaluate() expects a Response object.');
        }

        $success = $response->getStatusCode() == 200;

        if (!$success) {
            $this->fail($response, $description);
        }
    }
}
