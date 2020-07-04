<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Evenement
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\EventsRepository")
 */

class Evenement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;

    /**
     * @ORM\Column(type="string",length=255)
     *
     */
    private $titre;
    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", options={"default" : "en attente"}, length=255)
     */
    private $etat;
    /**
     * @ORM\Column(type="boolean")
     *
     */

    private $Realise;
    /**
     * @ORM\Column(type="string")
     *
     */

    private $place;

    /**
     * *
     * @ORM\Column(name="affiche", type="string", length=500)
     * @Assert\File(maxSize="500k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    public $affiche;
    /**
     * @ORM\Column(type="date")
     *
     */
    public $Dateajout;
    /**
     * @ORM\Column(type="integer")
     *
     */
    public $Nb;
    /**
     * @ORM\Column(type="time")
     *
     */

    public $heure;
    /**
     * @ORM\Column(type="integer" )
     *
     */

    public $vu;
    /**
     *
     * @Assert\Range(
     *      min = "1",
     *      max = "5"
     * )
     * @ORM\Column(name="etoile",  type="integer",nullable=true)
     */
    private $etoile;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="idcreateur", referencedColumnName="id" )
     */
    private $createur;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getRealise()
    {
        return $this->Realise;
    }

    /**
     * @param mixed $Realise
     */
    public function setRealise($Realise)
    {
        $this->Realise = $Realise;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param mixed $affiche
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    /**
     * @return mixed
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * @param mixed $createur
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;
    }

    /**
     * @return mixed
     */
    public function getDateajout()
    {
        return $this->Dateajout;
    }

    /**
     * @param mixed $Dateajout
     */
    public function setDateajout($Dateajout)
    {
        $this->Dateajout = $Dateajout;
    }

    /**
     * @return mixed
     */
    public function getNb()
    {
        return $this->Nb;
    }

    /**
     * @param mixed $Nb
     */
    public function setNb($Nb)
    {
        $this->Nb = $Nb;
    }

    /**
     * @return mixed
     */
    public function getVu()
    {
        return $this->vu;
    }

    /**
     * @param mixed $vu
     */
    public function setVu($vu)
    {
        $this->vu = $vu;
    }

    /**
     * @return int
     */
    public function getEtoile()
    {
        return $this->etoile;
    }

    /**
     * @param int $etoile
     */
    public function setEtoile($etoile)
    {
        $this->etoile = $etoile;
    }




}