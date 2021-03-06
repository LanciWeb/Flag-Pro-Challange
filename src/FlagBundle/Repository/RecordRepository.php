<?php

namespace FlagBundle\Repository;

/**
 * RecordRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecordRepository extends \Doctrine\ORM\EntityRepository
{
  public function FindFtNByChosenSet($set){
    return $this->getEntityManager()->createQuery("SELECT r FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ftn' ORDER BY r.points DESC")
    ->setMaxResults(10)->getResult();
  }


  public function FindNtFByChosenSet($set){
    return $this->getEntityManager()->createQuery("SELECT r FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ntf' ORDER BY r.points DESC")
    ->setMaxResults(10)->getResult();
}

public function FindLastFtNPosition($set){
  return $this->getEntityManager()->createQuery("SELECT MIN(r.points) FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ftn'")
  ->setMaxResults(1)->getOneOrNullResult();
}

public function FindLastNtFPosition($set){
  return $this->getEntityManager()->createQuery("SELECT MIN(r. points) FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ntf'")
  ->setMaxResults(1)->getOneOrNullResult();
}

public function findTenthFtNPosition($set, $puntiDecimo){
  return $this->getEntityManager()->createQuery("SELECT r FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ftn' AND r.points='$puntiDecimo'")
  ->setMaxResults(1)->getOneOrNullResult();
}

public function findTenthNtFPosition($set, $puntiDecimo){
  return $this->getEntityManager()->createQuery("SELECT r FROM FlagBundle:Record r WHERE r.flagset='$set' AND r.mode='ntf' AND r.points='$puntiDecimo'")
  ->setMaxResults(1)->getOneOrNullResult();
}

}
