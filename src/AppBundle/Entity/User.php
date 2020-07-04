<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $nom;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    private $prenom;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    private $adresse;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    private $gouvernorat;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $ville;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */

    private $telephone;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */

    private $fax;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_naissance;
    /**
     * @ORM\Column(type="date",nullable=true)
     */

    private $date_creation;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $genre;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    private $activite;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    private $adresse_siteweb;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */

    private $responsable_association;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */

    private $Membre_association;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $imageprofile;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="users")
     */
    private $challenges;

    //private $latitude;
    //private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PostLike", mappedBy="user")
     */
    private $likes;

    public function __construct()
    {
        parent::__construct();
        $this->challenges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set gouvernorat
     *
     * @param string $gouvernorat
     *
     * @return User
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return string
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return User
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return User
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set activite
     *
     * @param string $activite
     *
     * @return User
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return string
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Set adresseSiteweb
     *
     * @param string $adresseSiteweb
     *
     * @return User
     */
    public function setAdresseSiteweb($adresseSiteweb)
    {
        $this->adresse_siteweb = $adresseSiteweb;

        return $this;
    }

    /**
     * Get adresseSiteweb
     *
     * @return string
     */
    public function getAdresseSiteweb()
    {
        return $this->adresse_siteweb;
    }

    /**
     * Set responsableAssociation
     *
     * @param boolean $responsableAssociation
     *
     * @return User
     */
    public function setResponsableAssociation($responsableAssociation)
    {
        $this->responsable_association = $responsableAssociation;

        return $this;
    }

    /**
     * Get responsableAssociation
     *
     * @return boolean
     */
    public function getResponsableAssociation()
    {
        return $this->responsable_association;
    }

    /**
     * Set association
     *
     * @param \AppBundle\Entity\Association $association
     *
     * @return User
     */
    public function setAssociation(\AppBundle\Entity\Association $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \AppBundle\Entity\Association
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Add challenge
     *
     * @param \AppBundle\Entity\User $challenge
     *
     * @return User
     */
    public function addChallenge(\AppBundle\Entity\User $challenge)
    {
        $this->challenges[] = $challenge;

        return $this;
    }

    /**
     * Remove challenge
     *
     * @param \AppBundle\Entity\User $challenge
     */
    public function removeChallenge(\AppBundle\Entity\User $challenge)
    {
        $this->challenges->removeElement($challenge);
    }

    /**
     * Get challenges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChallenges()
    {
        return $this->challenges;
    }
    /**
     * Set imageprofile
     *
     * @param \AppBundle\Entity\Association $imageprofile
     *
     * @return User
     */
    public function setImageprofile($imageprofile)
    {
        $this->imageprofile = $imageprofile;

        return $this;
    }

    /**
     * Get imageprofile
     *
     * @return string
     */
    public function getImageprofile()
    {
        return $this->imageprofile;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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


}
