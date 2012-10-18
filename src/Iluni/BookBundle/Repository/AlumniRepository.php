<?php

namespace Iluni\BookBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Iluni\BookBundle\Repository\CommonConstraintRepository;

/**
 * AlumniRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @author E.R. Nurwijayadi <epsi.rns@gmail.com>
 */
class AlumniRepository extends CommonConstraintRepository
{
    protected static $order_by_choices = array(
        1  => 'r.id',   // default
        24 => 'r.name',

        11 => 'r.created',
        12 => 'r.updated',


        73  => 'r.birthdate',

        // 74..77: Need native query
        74  => 'a_day, r.name',
        75  => 'a_month, a_day, r.name',
        76  => 'a_year, a_month, a_day, r.name',
        77  => 'a_weekday, a_month, a_day, r.name',

        111 => 'ac.community, r.name',
        112 => 'ac.department, ac.program, ac.classYear, r.name',
        113 => 'ac.faculty, ac.department, ac.program, ac.classYear, r.name',
        114 => 'ac.program, ac.department, ac.classYear, r.name',
        115 => 'ac.classYear, ac.department, r.name'    // default
    );

    public function findQueryFilter($constraint = array())
    {
        $this->qb = $this->createQueryBuilder('r')
            ->select('r, ac, c')
            ->leftJoin('r.acommunities', 'ac')
            ->leftJoin('ac.community', 'c');

        $this->checkConstraintOrderBy($constraint);
        $this->checkConstraintAlumni($constraint);
        $this->checkConstraintCommunity($constraint);

        return $this->qb->getQuery();
    }

    protected function checkConstraintAlumni($constraint = array())
    {
        if (isset($constraint['name'])) {
            $this->qb
                ->andWhere('r.name LIKE :name')
                ->setParameter('name', $constraint['name']);
        }

        if (isset($constraint['update_st'])) {
            $range_start = new \DateTime($constraint['update_st']);
            $this->qb
                ->andWhere('r.updated >= :update_st')
                ->setParameter('update_st', $range_start);
        }

        if (isset($constraint['update_nd'])) {
            $range_end = new \DateTime($constraint['update_nd']);
            $this->qb
                ->andWhere('r.updated <= :update_nd')
                ->setParameter('update_nd', $range_end);
        }
    }

    public function findQueryBirthdayFilter($constraint = array())
    {
        $this->qb = $this->createQueryBuilder('r')
            ->select('r, ac')
            ->leftJoin('r.acommunities', 'ac')
            ->where('r.birthdate is not null');
        /*
        // Warning: mySQL specific
        $query = Doctrine_Core::getTable('Alumni')
          ->createQuery('a')
          ->select('a.aid, a.name, a.fullname, '
            .'a.gender, a.created_at, a.birthdate, '
            .'WEEKDAY(a.birthdate) as a_weekday, '
            .'DAYOFMONTH(a.birthdate) as a_day, '
            .'MONTH(a.birthdate) as a_month, '
            .'YEAR(a.birthdate) as a_year, '
            .'ac.*'
            )
          ->leftJoin('a.ACommunities ac')
          ->andWhere('a.birthdate is not null');
        */

        $this->checkConstraintOrderBy($constraint);
        $this->checkConstraintCommunity($constraint);

        return $this->qb->getQuery();
    }

    public function findQueryNameLike($name = null)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->orderBy('r.name');

        if (!empty($name)) {
            $qb ->andWhere('r.name LIKE :name')
                ->setParameter('name', $name);
        }

        return $qb->getQuery();
    }

    public function findForAtom()
    {
        $offset = 0;
        $limit = 10;

        $qb = $this->createQueryBuilder('r')
            ->select('r, ac')
            ->leftJoin('r.acommunities', 'ac')
            ->orderBy('r.updated', 'DESC')
            ->where('r.updated <= :now')
            ->setParameter('now', new \DateTime)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getFirstId()
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->select('min(r.id) as id');

        $query = $queryBuilder->getQuery();
        $row = $query->getSingleResult();

        return $row['id'];
    }

    public function getLastUpdate()
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->select('max(r.updated) as last_update');

        $query = $queryBuilder->getQuery();
        $row = $query->getSingleResult();

        return $row['last_update'];
    }

    public function getLastUpdateOldCode($translator)
    {
        $last_update = $this->getLastUpdate();

        $format = '%A, %e %B %Y, %T';
        $format = $translator->trans($format);

        $timelastupdate = strtotime($last_update);
        $lastupdatetext = strftime($format, $timelastupdate);

        return $lastupdatetext;
    }

    public function getLastUpdateForCover2()
    {
        $last_update = $this->getLastUpdate();
        $format = 'l, j F Y, H:i:s';

        $updated = new \DateTime(trim($last_update));
        $lastupdatetext = $updated->format($format);

        return $lastupdatetext;
    }

    public function getLastUpdateForCover($translator)
    {
        $last_update = $this->getLastUpdate();
        $updated = new \DateTime(trim($last_update));
        $all = '%\s, j %\s Y, H:i:s';

        $dayweek = $translator
            ->trans($updated->format('l'), array(), 'calendar');
        $month   = $translator
            ->trans($updated->format('F'), array(), 'calendar');
        $format    = $translator
            ->trans($updated->format($all), array(), 'calendar');

        $final = sprintf($format, $dayweek, $month);


        return $final;
    }
}
