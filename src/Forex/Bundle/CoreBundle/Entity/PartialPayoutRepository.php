<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Forex\Bundle\CoreBundle\Entity\User;

class PartialPayoutRepository extends EntityRepository
{
    public function getUnresolvedPartialPayouts(User $user)
    {
        return $this->createQueryBuilder('pp')
            ->where('pp.user = :user')
            ->andWhere('pp.payout is null')
            ->setParameter('user', $user)
            ->orderBy('pp.amount', 'DESC')
            ->getQuery()
            ->execute();
    }
}
