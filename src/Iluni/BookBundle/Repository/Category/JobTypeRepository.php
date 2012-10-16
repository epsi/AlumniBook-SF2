<?php

namespace Iluni\BookBundle\Repository\Category;

use Doctrine\ORM\EntityRepository;

/**
 * JobTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobTypeRepository extends EntityRepository
{
    public function findCategories()
    {
        $qb = $this->createQueryBuilder('r')
            ->select('r, count(m) as total')
            ->leftJoin('r.alumni_org_map', 'm')
            ->groupBy('r.id')
            ->orderBy('r.id');

        $query = $qb->getQuery();
        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );
        return $query->getResult();
    }
}

