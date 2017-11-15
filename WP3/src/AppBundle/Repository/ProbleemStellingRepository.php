<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Issue;
use Doctrine\ORM\EntityRepository;

class ProbleemStellingRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllUnhandledIssuesByUser($user) {
        return $this->getEntityManager()
            ->createQuery('SELECT i FROM AppBundle:Issue i WHERE i.technician = :user AND i.handled = :handled'
            )->setParameter('user', $user)->setParameter('handled', 'false')->getResult();
    }
}
