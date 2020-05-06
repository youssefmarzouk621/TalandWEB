<?php

namespace EventsBundle\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;


/**
 * EventsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventsRepository extends \Doctrine\ORM\EntityRepository
{
    public function search($chaine){
        return $this->getEntityManager()->createQuery('select c from EventsBundle:Competition c WHERE CONCAT(c.namecomp,c.location) LIKE :chaine')
                                        ->setParameter('chaine','%'.$chaine.'%')
                                        ->getResult();
    }

    public function VerifUserParticipated($idcomp,$idu)
    {

        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(c) FROM EventsBundle:Competitionuser c WHERE c.idu ='$idu' AND c.idcomp = '$idcomp' ");
        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }
    }
}