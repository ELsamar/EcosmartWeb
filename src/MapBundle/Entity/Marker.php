<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 2/23/2019
 * Time: 11:37 PM
 */

namespace MapBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

    /**
     * Marker
     *
     * @ORM\Table(name="marker")
     * @ORM\Entity()
     */
class Marker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;
    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;
    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float")
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * *
     * @ORM\Column(name="imagemarker", type="string", length=500 , nullable=true)
     * @Assert\File(maxSize="500k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    public $imagemarker;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="idcreateur", referencedColumnName="id" ,nullable=true)
     */
    private $createur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Marker
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Marker
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }
    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }
    /**
     * Set lng
     *
     * @param float $lng
     *
     * @return Marker
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }
    /**
     * Get lng
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getImagemarker()
    {
        return $this->imagemarker;
    }

    /**
     * @param mixed $imagemarker
     */
    public function setImagemarker($imagemarker)
    {
        $this->imagemarker = $imagemarker;
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



}