<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 2/16/2019
 * Time: 7:09 PM
 */

namespace EvenementBundle\Repository;


class ParticipRepository extends \Doctrine\ORM\EntityRepository
{
    public function Findparti($user,$event){
        $query=$this->getEntityManager()
            ->createQuery("
            select p from AppBundle:Participation p
            where p.participant=:personne
            and p.event=:event
            and p.type=:type")
           // -> setParameters (array ('personne'=>'$user', 'id'=>2)
            ->setParameter('personne',$user)
        ->setParameter('event',$event)
        ->setParameter('type','participer');

        return $query->getOneOrNullResult();
    }
    public function FindUsersPart($event){
        $query=$this->getEntityManager()
            ->createQuery("
            select u from AppBundle:User u
            where AppBundle:Participation p.event=:event
            and p.participant = u")
            ->setParameter('event',$event);
        return $query->getResult();
    }

    public function countparticip($event)
    {$query = $this->getEntityManager()
        ->createQuery('SELECT COUNT(p.id) FROM AppBundle:Participation p
        where p.type=:type
         and p.event=:event')
        ->setParameter('event',$event)
        ->setParameter('type','participer');
    return $result = $query->getSingleScalarResult();}
    public function countinvite($event)
    {$query = $this->getEntityManager()
        ->createQuery('SELECT COUNT(p.id) FROM AppBundle:Participation p
        where p.type=:type
        and p.event=:event')
        ->setParameter('event',$event)
        ->setParameter('type','inviter');
        return $result = $query->getSingleScalarResult();}
    public function FindParticipant($event){
        $query=$this->getEntityManager()->createQuery("
            select p from AppBundle:Participation p
            where  p.event=:event")
            ->setParameter('event',$event);
            return $query->getResult();
    }
    public function Filterparti($event){
        $query=$this->getEntityManager()
            ->createQuery("
            select p from AppBundle:Participation p
            where  p.event=:event
            and p.type=:type")
            ->setParameter('event',$event)
            ->setParameter('type','participer');

        return $query->getResult();
    }
    public function Filterinvi($event){
        $query=$this->getEntityManager()
            ->createQuery("
            select p from AppBundle:Participation p
            where  p.event=:event
            and p.type=:type")
            ->setParameter('event',$event)
            ->setParameter('type','inviter');

        return $query->getResult();
    }
}