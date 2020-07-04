<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 2/23/2019
 * Time: 6:02 PM
 */

namespace AppBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function FindUser($username){
        $query=$this->getEntityManager()
            ->createQuery("
            select u from AppBundle:User u
           where u.username like :username")
            ->setParameter('username',$username.'%');
        return $query->getResult();
    }
}