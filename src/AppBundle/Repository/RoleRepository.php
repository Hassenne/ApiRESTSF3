<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 16/10/2018
 * Time: 12:56
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository
{
    public function getCountForMovie(int $movieId): int
    {
        $qb = $this->createQueryBuilder('r');

        return $qb->select('count(r.id)')
            ->where('r.movie = :movieId')
            ->setParameter('movieId', $movieId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}