<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 2/16/2019
 * Time: 5:38 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class DemandeAssociation
 * @ORM\Entity
 */

class DemandeAssociation
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
    private $nom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Email;
    /**
     * @ORM\Column(type="integer")
     */
    private $NumTel;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Qualite;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Experience;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Motivation;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Etat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *@ORM\JoinColumn(name="User_id", referencedColumnName="id")
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Association")
     *@ORM\JoinColumn(name="Assoc_id", referencedColumnName="id")
     */
    private $Association;

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
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->Etat;
    }

    /**
     * @param mixed $Etat
     */
    public function setEtat($Etat)
    {
        $this->Etat = $Etat;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getNumTel()
    {
        return $this->NumTel;
    }

    /**
     * @param mixed $NumTel
     */
    public function setNumTel($NumTel)
    {
        $this->NumTel = $NumTel;
    }

    /**
     * @return mixed
     */
    public function getQualite()
    {
        return $this->Qualite;
    }

    /**
     * @param mixed $Qualite
     */
    public function setQualite($Qualite)
    {
        $this->Qualite = $Qualite;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->Experience;
    }

    /**
     * @param mixed $Experience
     */
    public function setExperience($Experience)
    {
        $this->Experience = $Experience;
    }

    /**
     * @return mixed
     */
    public function getMotivation()
    {
        return $this->Motivation;
    }

    /**
     * @param mixed $Motivation
     */
    public function setMotivation($Motivation)
    {
        $this->Motivation = $Motivation;
    }


    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->Association;
    }

    /**
     * @param mixed $Association
     */
    public function setAssociation($Association)
    {
        $this->Association = $Association;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->Utilisateur;
    }

    /**
     * @param mixed $Utilisateur
     */
    public function setUtilisateur($Utilisateur)
    {
        $this->Utilisateur = $Utilisateur;
    }








}