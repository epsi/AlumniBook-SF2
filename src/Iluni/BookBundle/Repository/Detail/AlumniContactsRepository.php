<?php

namespace Iluni\BookBundle\Repository\Detail;

use Iluni\BookBundle\Repository\CommonConstraintRepository;

/**
 * AContactsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlumniContactsRepository extends CommonConstraintRepository
{
    protected static $order_by_choices = array(
        6  => 'r.id',
        21 => 'a.name',
        47 => 'ct.id'
    );

    public function findQueryFilter($constraint = array())
    {
        $this->qb = $this->createQueryBuilder('r')
            ->select('r, a, ac, ct')
            ->leftJoin('r.alumni', 'a')
            ->leftJoin('a.acommunities', 'ac')
            ->leftJoin('r.contactType', 'ct');

        $this->checkConstraintOrderBy($constraint);
        $this->checkConstraintContactType($constraint);
        $this->checkConstraintCommunity($constraint);

        return $this->qb->getQuery();
    }

    public function findList($aid)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('r, ct')
            ->leftJoin('r.alumni', 'a')
            ->leftJoin('r.contactType', 'ct')
            ->where('a.id = :aid')
            ->setParameter('aid', $aid);

        $query = $qb->getQuery();
        return $query->getResult();
    }
}

