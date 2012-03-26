<?php

namespace Jimdo\JimKanWall\ImportBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SnapShotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SnapShotRepository extends EntityRepository
{
    public function getPreBuildSnapShotById($snapshot_id)
    {
        $qb = $this->createQueryBuilder('s')
                   ->select('s,b, c, t')
                   ->leftJoin('s.board', 'b')
                   ->leftJoin('b.boardColumns', 'c')
                   ->leftJoin('c.ticketsToColumn', 't')
                   ->where('s.id = ?1')
                   ->andWhere('t.snapShot = ?1')
                   ->addOrderBy('c.ordering', 'ASC')
                   ->setParameter('1', $snapshot_id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getNewestSnapShotByBoard($board_id)
    {
        $qb = $this->createQueryBuilder('s')
                   ->select('s')
                   ->where('s.board = ?1')
                   ->addOrderBy('s.createdAt', 'DESC')
                   ->setParameter('1', $board_id);

        return $qb->getQuery()->getResult();
    }
}