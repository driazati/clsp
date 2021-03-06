<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleCn (Module Culture Notes)
 *
 * @ORM\Table(name="module_cn")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleCnRepository")
 */
class ModuleCn
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
     * One ModuleCn has One Song
     * @ORM\OneToOne(targetEntity="Song", inversedBy="moduleCn")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $song;

    /**
     * One ModuleCn has Many ModuleCnKeyword.
     * @ORM\OneToMany(targetEntity="ModuleCnKeyword", mappedBy="moduleCn")
     */
    private $keywords;

    public function __construct() {
        $this->keywords = new ArrayCollection();
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
     * @return ModuleCn
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
     * @return ModuleCn
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
     * @return ModuleCn
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
     * @return ModuleCn
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
     * @return ModuleCn
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
     * Add keyword
     *
     * @param \AppBundle\Entity\ModuleCnKeyword $keyword
     *
     * @return ModuleCn
     */
    public function addKeyword(\AppBundle\Entity\ModuleCnKeyword $keyword)
    {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\ModuleCnKeyword $keyword
     */
    public function removeKeyword(\AppBundle\Entity\ModuleCnKeyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set songEnabled
     *
     * @param boolean $songEnabled
     *
     * @return ModuleCn
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
