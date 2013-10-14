<?php

namespace Forex\Bundle\EmailBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;

class EmailMessageRepository extends EntityRepository
{
    protected function createPendingQueryBuilder()
    {
        $qb = $this->createQueryBuilder('m');

        return $qb
            ->where('m.status = :status')
            ->setParameter('status', EmailMessage::STATUS_PENDING);
    }

    public function findPendingEmails()
    {
        return $this->createPendingQueryBuilder()
            ->getQuery()
            ->execute();
    }
}
