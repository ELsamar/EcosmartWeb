<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 15/2/2019
 * Time: 08:31 PM
 */
namespace EvenementBundle\Repository;


class EventsRepository extends \Doctrine\ORM\EntityRepository
{

    public function FindMyEv($user){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from AppBundle:Evenement e
            where e.createur=:personne")
            ->setParameter('personne',$user);
        return $query->getResult();
    }

    public function FindAcceptedEv(){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from AppBundle:Evenement e
            where e.etat='accepted'");
        return $query->getResult();
    }

    public function FindNonAcceptedEv(){
        $query=$this->getEntityManager()
            ->createQuery("select e from AppBundle:Evenement e where e.etat='en attente'");

        return $query->getResult();
    }

    public function FindByName($motcle){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from AppBundle:Evenement e
            where e.titre like :motcle")
            ->setParameter('motcle',$motcle.'%');
        return $query->getResult();
    }

    public function FindByType($motcle){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from AppBundle:Evenement e
            where e.categorie like :motcle")
            ->setParameter('motcle',$motcle.'%');
        return $query->getResult();
    }
    public function FindAjax($search)
    {/*$date_from = new \DateTime('now');
        ->setParameter('date_from', $date_from)
        ->andWhere('e.datedeb > = :date_form')*/

        return $this->createQueryBuilder('e')
            ->andWhere('e.titre LIKE :titre')
            ->setParameter('titre','%' .$search . '%')
            ->getQuery()
            ->getResult();
    }

    public function ORDERBYevent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         where e.etat='accepted'
         ORDER BY e.start ASC");
    return $result = $query->getResult();}

    public function ORDERBYetoileevent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         where e.etat='accepted'
         ORDER BY e.etoile DESC");
        return $result = $query->getResult();}
    public function ORDERBYparticipantevent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         where e.etat='accepted'
         ORDER BY e.Nb DESC");
        return $result = $query->getResult();}

    public function TopEvent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         ORDER BY e.Nb DESC");
        return $result = $query->setMaxResults(1)->getResult();
    }
    public function TopetoileEvent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         ORDER BY e.etoile DESC");
        return $result = $query->setMaxResults(1)->getResult();
    }
    public function Top10event()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM AppBundle:Evenement e 
         ORDER BY e.Nb DESC");
        return $result = $query->setMaxResults(2)->getResult();}
    public function TopOrgonizer($event)
    {$query = $this->getEntityManager()
        ->createQuery('SELECT e.createur , COUNT(e.id) FROM AppBundle:Evenement e
        where 
         and ')
       ; //à completer
        return $result = $query->getSingleScalarResult();}
}
