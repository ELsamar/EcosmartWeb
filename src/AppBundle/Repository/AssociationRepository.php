<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 2/21/2019
 * Time: 8:18 PM
 */

namespace AppBundle\Repository;
use AppBundle\Entity\MembreAssociation;

use Doctrine\ORM\EntityRepository;

class AssociationRepository extends  EntityRepository
{

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM AppBundle:Association e WHERE e.nom LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
}