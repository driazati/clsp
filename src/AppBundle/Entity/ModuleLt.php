<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleLt (Module Listening Tasks)
 *
 * @ORM\Table(name="module_lt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleLtRepository")
 */
class ModuleLt
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
     * One ModuleLt has One Song
     * @ORM\OneToOne(targetEntity="Song", inversedBy="moduleLt")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id")
     */
    private $song;

    /**
     * One ModuleLt has Many Question Headings.
     * @ORM\OneToMany(targetEntity="ModuleQuestionHeading", mappedBy="moduleLt")
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
     * @return ModuleLt
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
     * @return ModuleLt
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
     * @return ModuleLt
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
     * @return ModuleLt
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
