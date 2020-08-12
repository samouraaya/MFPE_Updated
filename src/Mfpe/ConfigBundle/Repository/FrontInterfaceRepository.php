<?php

namespace Mfpe\ConfigBundle\Repository;

/**
 * FrontInterfaceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FrontInterfaceRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAllFrontInterfaces()
    {
        $qb = $this
            ->createQueryBuilder("FrontInterface")
            ->select("FrontInterface.id, FrontInterface.routePrefix, FrontInterface.routeSufix")
            ->groupBy("FrontInterface.routePrefix");
        return $qb->getQuery()->getArrayResult();
    }

}