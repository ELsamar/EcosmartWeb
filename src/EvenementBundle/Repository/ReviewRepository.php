<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 2/26/2019
 * Time: 11:22 AM
 */

namespace EvenementBundle\Repository;


class ReviewRepository extends \Doctrine\ORM\EntityRepository
{
    public function FindReviwEvent($event){
        $query=$this->getEntityManager()
            ->createQuery("
            select r from AppBundle:Review r
            where r.event=:event")
            ->setParameter('event',$event);
        return $query->getResult();
    }
}