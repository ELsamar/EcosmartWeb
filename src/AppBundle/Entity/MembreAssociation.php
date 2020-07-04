<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MembreAssociation
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembreRepository")
 */

class MembreAssociation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Nom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Adresse;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $NumContact;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $Score;
    /**
     * @ORM\Column(name="id_Assoc",type="integer")
     */
    private $Assoc;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Association", inversedBy="Membres")
     * @ORM\JoinTable(name="Membres_Assoc")
     */
    private $Associations;

    /**
     * @return mixed
     */
    public function getAssoc()
    {
        return $this->Assoc;
    }

    /**
     * @param mixed $Assoc
     */
    public function setAssoc($Assoc)
    {
        $this->Assoc = $Assoc;
    }


    /**
     * MembreAssociation constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param mixed $Nom
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * @param mixed $Prenom
     */
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * @param mixed $Adresse
     */
    public function setAdresse($Adresse)
    {
        $this->Adresse = $Adresse;
    }

    /**
     * @return mixed
     */
    public function getNumContact()
    {
        return $this->NumContact;
    }

    /**
     * @param mixed $NumContact
     */
    public function setNumContact($NumContact)
    {
        $this->NumContact = $NumContact;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->Score;
    }

    /**
     * @param mixed $Score
     */
    public function setScore($Score)
    {
        $this->Score = $Score;
    }

    /**
     * @return mixed
     */
    public function getAssociations()
    {
        return $this->Associations;
    }

    /**
     * @param mixed $Associations
     */
    public function setAssociations($Associations)
    {
        $this->Associations = $Associations;
    }





}




