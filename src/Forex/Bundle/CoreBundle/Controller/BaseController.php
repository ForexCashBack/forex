<?php

namespace Forex\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    protected function getRepository($class)
    {
        return $this->getEntityManager()->getRepository($class);
    }
}
