<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleGe (Module Grammar Exercise)
 *
 * @ORM\Table(name="module_ge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleGeRepository")
 */
class ModuleGe
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
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $hasPassword;

    /**
     * One ModuleGe has One Song
     * @ORM\OneToOne(targetEntity="Song", inversedBy="moduleGe")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id")
     */
    private $song;

    /**
     * One ModuleGe has Many Question Headings.
     * @ORM\OneToMany(targetEntity="ModuleQuestionHeading", mappedBy="moduleGe")
     */
    private $headings;

    public function __construct() {
        $this->headings = new ArrayCollection();
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
     * Set password
     *
     * @param string $password
     *
     * @return ModuleGe
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set hasPassword
     *
     * @param boolean $hasPassword
     *
     * @return ModuleGe
     */
    public function setHasPassword($hasPassword)
    {
        $this->hasPassword = $hasPassword;

        return $this;
    }

    /**
     * Get hasPassword
     *
     * @return boolean
     */
    public function getHasPassword()
    {
        return $this->hasPassword;
    }

    /**
     * Set song
     *
     * @param \AppBundle\Entity\Song $song
     *
     * @return ModuleGe
     */
    public function setSong(\AppBundle\Entity\Song $song = null)
    {
        $this->song = $song;

        return $this;
    }

    /**
     * Get song
     *
     * @return \AppBundle\Entity\Song
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Add heading
     *
     * @param \AppBundle\Entity\ModuleQuestionHeading $heading
     *
     * @return ModuleGe
     */
    public function addHeading(\AppBundle\Entity\ModuleQuestionHeading $heading)
    {
        $this->headings[] = $heading;

        return $this;
    }

    /**
     * Remove heading
     *
     * @param \AppBundle\Entity\ModuleQuestionHeading $heading
     */
    public function removeHeading(\AppBundle\Entity\ModuleQuestionHeading $heading)
    {
        $this->headings->removeElement($heading);
    }

    /**
     * Get headings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeadings()
    {
        return $this->headings;
    }
}
