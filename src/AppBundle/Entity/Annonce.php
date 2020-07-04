<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
use AppBundle\Entity\User;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 */

class Annonce implements  NotifiableInterface
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="photo", type="string", length=500)
     * @Assert\File(maxSize="500k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaireannonce", mappedBy="annonce",cascade={"remove"})
     */
    private $commentaires;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PostLike", mappedBy="annonce",cascade={"remove"})
     */
    private $likes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateannonce", type="date")
     */
    private $dateannonce;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $altitude;
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *@ORM\JoinColumn(name="createur", referencedColumnName="id", onDelete="CASCADE")
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param mixed $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return \DateTime
     */
    public function getDateannonce()
    {
        return $this->dateannonce;
    }

    /**
     * @param \DateTime $dateannonce
     */
    public function setDateannonce($dateannonce)
    {
        $this->dateannonce = $dateannonce;
    }
    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
    public function __toString()
    {
        return 'My string version of UserCategory'; // if you have a name property you can do $this->getName();
    }
    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
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

    /**
     * Build notifications on entity creation
     * @param NotificationBuilder $builder
     * @return NotificationBuilder
     */
    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('Nouvelle Annonce')
            ->setDescription($this->titre)
            ->setRoute('annonce_show')
            ->setSeen(0)


            ->setParameters(array('id'=> $this->id));
        $builder
            ->addNotification($notification);
        return $builder;
    }
    /**
     * Build notifications on entity update
     * @param NotificationBuilder $builder
     * @return NotificationBuilder
     */
    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('Update Annonce')
            ->setDescription($this->titre)
            ->setRoute('annonce_show')

            ->setParameters(array('id'=> $this->id));
        $builder
            ->addNotification($notification);
        return $builder;
    }

    /**
     * Build notifications on entity delete
     * @param NotificationBuilder $builder
     * @return NotificationBuilder
     */
    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        return $builder;
    }
}
