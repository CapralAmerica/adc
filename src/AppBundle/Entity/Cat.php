<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cat
 *
 * @ORM\Table(name="cat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CatRepository")
 */
class Cat
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=255)
     */
    private $colour;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var bool
     *
     * @ORM\Column(name="isSterilized", type="boolean")
     */
    private $isSterilized;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_long", type="string", length=255, nullable=true)
     */
    private $gpsLong;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_lat", type="string", length=255, nullable=true)
     */
    private $gpsLat;

    /**
     * @var string
     *
     * @ORM\Column(name="guardian_mobile", type="string", length=255)
     */
    private $guardianMobile;

    /**
     * @ORM\Column(name="added_at", type="datetime")
     */
    private $addedAt;


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
     * @return Cat
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
     * Set colour
     *
     * @param string $colour
     *
     * @return Cat
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Cat
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return Cat
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set isSterilized
     *
     * @param boolean $isSterilized
     *
     * @return Cat
     */
    public function setIsSterilized($isSterilized)
    {
        $this->isSterilized = $isSterilized;

        return $this;
    }

    /**
     * Get isSterilized
     *
     * @return bool
     */
    public function getIsSterilized()
    {
        return $this->isSterilized;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Cat
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set gpsLong
     *
     * @param string $gpsLong
     *
     * @return Cat
     */
    public function setGpsLong($gpsLong)
    {
        $this->gpsLong = $gpsLong;

        return $this;
    }

    /**
     * Get gpsLong
     *
     * @return string
     */
    public function getGpsLong()
    {
        return $this->gpsLong;
    }

    /**
     * Set gpsLat
     *
     * @param string $gpsLat
     *
     * @return Cat
     */
    public function setGpsLat($gpsLat)
    {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    /**
     * Get gpsLat
     *
     * @return string
     */
    public function getGpsLat()
    {
        return $this->gpsLat;
    }

    /**
     * Set guardianMobile
     *
     * @param string $guardianMobile
     *
     * @return Cat
     */
    public function setGuardianMobile($guardianMobile)
    {
        $this->guardianMobile = $guardianMobile;

        return $this;
    }

    /**
     * Get guardianMobile
     *
     * @return string
     */
    public function getGuardianMobile()
    {
        return $this->guardianMobile;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Cat
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return Cat
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }
}
