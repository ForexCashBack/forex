<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BrokerRepository extends EntityRepository
{
    protected function createActiveQueryBuilder()
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            //->where('active')->equals(true)
            ->orderBy('p.rank');
    }

    public function findActive()
    {
        return $this->createActiveQueryBuilder()
            ->getQuery()
            ->execute();
    }
}
