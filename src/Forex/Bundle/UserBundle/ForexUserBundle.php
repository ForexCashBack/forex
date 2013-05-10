<?php

namespace Forex\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ForexUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
