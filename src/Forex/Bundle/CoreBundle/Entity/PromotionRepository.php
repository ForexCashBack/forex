<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PromotionRepository extends EntityRepository
{
    protected function createActiveQueryBuilder()
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->where($qb->expr()->andX(
                $qb->expr()->lte('p.startTime', ':now'),
                $qb->expr()->gte('p.endTime', ':now')
            ))
            ->setParameter('now', new \DateTime());
    }

    public function findActive()
    {
        return $this->createActiveQueryBuilder()
            ->getQuery()
            ->execute();
    }
}
