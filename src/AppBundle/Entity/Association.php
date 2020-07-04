<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Association
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssociationRepository")
 **/

class Association
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
    private $Description;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Adresse;
    /**
     * @ORM\Column(type="integer")
     */
    private $NumContact;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $site;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MembreAssociation", mappedBy="Associations")
     */
    private $Membres;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg","image/png","image/GIF" })
     */
    private $logo;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PostLikeAssociation", mappedBy="association")
     */
    private $likes;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *@ORM\JoinColumn(name="id_resp", referencedColumnName="id")
     */
    private $Responsable;


    /**
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }


    /**
     * @param mixed $Responsable
     */
    public function setResponsable($Responsable)
    {
        $this->Responsable = $Responsable;
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
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
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
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getMembres()
    {
        return $this->Membres;
    }

    /**
     * @param mixed $Membres
     */
    public function setMembres($Membres)
    {
        $this->Membres = $Membres;
    }
   /**
     * @param User $user
     * @return bool
     */
   /*  public function isLikeByUser(User $user): bool
     {
         foreach ($this->likes as $like) {
             if ($like->getUser() === $user) return true;
         }
         return false;
     }*/


}
