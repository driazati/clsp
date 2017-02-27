<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnitRepository")
 */
class Unit
{
    /**
     * @var int $id Unique Unit ID
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name Name of the Unit
     *
     * @ORM\Column(type = "string", length = 255)
     */
    private $name;

    /**
     * @var string $description Description for the Unit
     *
     * @ORM\Column(type = "string")
     */
    private $description;

    /**
     * Many Units have One Course.
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="units")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    private $course;

    /**
     * One Unit has Many Songs
     * @ORM\OneToMany(targetEntity="Song", mappedBy="unit")
     */
    private $songs;

    public function __construct() {
        $this->songs = new ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
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
     * @return Unit
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
     * Set description
     *
     * @param string $description
     *
     * @return Unit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Unit
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Add song
     *
     * @param \AppBundle\Entity\Song $song
     *
     * @return Unit
     */
    public function addSong(\AppBundle\Entity\Song $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * Remove song
     *
     * @param \AppBundle\Entity\Song $song
     */
    public function removeSong(\AppBundle\Entity\Song $song)
    {
        $this->songs->removeElement($song);
    }

    /**
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSongs()
    {
        return $this->songs;
    }
}
