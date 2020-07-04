<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 2/23/2019
 * Time: 9:32 PM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MembreRepository extends  EntityRepository
{
    public function countmembre($id)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.id) FROM AppBundle:MembreAssociation m where m.Assoc=:id')
            ->setParameter('id',$id);
        return $result = $query->getSingleScalarResult();
    }

}