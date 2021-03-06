<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleDw (Module Discussion and Writing)
 *
 * @ORM\Table(name="module_dw")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleDwRepository")
 */
class ModuleDw
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
     * @ORM\Column(type="string", length=64, nullable = True)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable = True)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $hasPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isEnabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="song_enabled", type="boolean")
     */
    private $songEnabled;

    /**
     * One ModuleDw has One Song
     * @ORM\OneToOne(targetEntity="Song", inversedBy="moduleDw")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $song;

    /**
     * One ModuleDw has Many Question Headings.
     * @ORM\OneToMany(targetEntity="ModuleQuestionHeading", mappedBy="moduleDw")
     */
    private $headings;

    public function __construct() {
        $this->headings = new ArrayCollection();
    }

    /*********************************
     * Autogenerated getters/setters *
     *********************************
     */




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
     * @return ModuleDw
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
     * Set name
     *
     * @param string $name
     *
     * @return ModuleDw
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
     * Set hasPassword
     *
     * @param boolean $hasPassword
     *
     * @return ModuleDw
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
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return ModuleDw
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Set song
     *
     * @param \AppBundle\Entity\Song $song
     *
     * @return ModuleDw
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
     * @return ModuleDw
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

    /**
     * Set songEnabled
     *
     * @param boolean $songEnabled
     *
     * @return ModuleDw
     */
    public function setSongEnabled($songEnabled)
    {
        $this->songEnabled = $songEnabled;

        return $this;
    }

    /**
     * Get songEnabled
     *
     * @return boolean
     */
    public function getSongEnabled()
    {
        return $this->songEnabled;
    }
}
