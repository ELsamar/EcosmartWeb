<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participation
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\ParticipRepository")
 */

class Participation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;
    /**
     * @ORM\Column(type="date")
     */

    private $datedeparti;
    /**
     * @ORM\Column(type="string",length=250)
     */

    private $type; //participer inviter interesser
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Evenement")
     * @ORM\JoinColumn(name="idevents", referencedColumnName="id",onDelete="CASCADE")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="idparticipant", referencedColumnName="id")
     */

    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="idinvitant", referencedColumnName="id",nullable=true)
     */

    private $invitant;

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
    public function getDatedeparti()
    {
        return $this->datedeparti;
    }

    /**
     * @param mixed $datedeparti
     */
    public function setDatedeparti($datedeparti)
    {
        $this->datedeparti = $datedeparti;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return User
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return mixed
     */
    public function getInvitant()
    {
        return $this->invitant;
    }

    /**
     * @param mixed $invitant
     */
    public function setInvitant($invitant)
    {
        $this->invitant = $invitant;
    }

}