<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Song
 *
 * @ORM\Table(name="song")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SongRepository")
 */
class Song
{
    /**
     * @var int $id Unique Song ID
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title Song Title
     *
     * @ORM\Column(type = "string", length = 255)
     */
    private $title;

    /**
     * @var string $weight Weight for sorting
     *
     * @ORM\Column(type = "integer")
     */
    private $weight;

    /**
     * @var string $album Song Album
     *
     * @ORM\Column(type = "string", length = 255)
     */
    private $album;

    /**
     * @var string $artist Song Artist
     *
     * @ORM\Column(type = "string", length = 255)
     */
    private $artist;

    /**
     * @var string $description Song Description
     *
     * @ORM\Column(type = "text")
     */
    private $description;

    /**
     * @var string $lyrics Song Lyrics
     *
     * @ORM\Column(type = "text")
     */
    private $lyrics;

    /**
     * @var string $embed Embed Code for a Song
     *
     * @ORM\Column(type = "string", length = 1000, nullable=true)
     */
    private $embed;

    /**
     * Many Songs have One Unit.
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="songs")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $unit;

    /**
     * One Song has One ModuleCn
     * @ORM\OneToOne(targetEntity="ModuleCn", mappedBy="song")
     */
    private $moduleCn;

    /**
     * One Song has One ModuleQu
     * @ORM\OneToOne(targetEntity="ModuleQu", mappedBy="song")
     */
    private $moduleQu;

    /**
     * One Song has One ModuleLt
     * @ORM\OneToOne(targetEntity="ModuleLt", mappedBy="song")
     */
    private $moduleLt;

    /**
     * One Song has One ModuleGe
     * @ORM\OneToOne(targetEntity="ModuleGe", mappedBy="song")
     */
    private $moduleGe;

    /**
     * One Song has One ModuleDw
     * @ORM\OneToOne(targetEntity="ModuleDw", mappedBy="song")
     */
    private $moduleDw;

    /**
     * One Song has One ModuleLs
     * @ORM\OneToOne(targetEntity="ModuleLs", mappedBy="song")
     */
    private $moduleLs;

    /**
     * Many Songs have Many Media
     * @ORM\ManyToMany(targetEntity="Media", inversedBy="songs")
     * @ORM\JoinTable("songs_media")
     */
    private $media;

    public function __construct() {
        $this->media = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Song
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Song
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set album
     *
     * @param string $album
     *
     * @return Song
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set artist
     *
     * @param string $artist
     *
     * @return Song
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Song
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
     * Set lyrics
     *
     * @param string $lyrics
     *
     * @return Song
     */
    public function setLyrics($lyrics)
    {
        $this->lyrics = $lyrics;

        return $this;
    }

    /**
     * Get lyrics
     *
     * @return string
     */
    public function getLyrics()
    {
        return $this->lyrics;
    }

    /**
     * Set embed
     *
     * @param string $embed
     *
     * @return Song
     */
    public function setEmbed($embed)
    {
        $this->embed = $embed;

        return $this;
    }

    /**
     * Get embed
     *
     * @return string
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Unit $unit
     *
     * @return Song
     */
    public function setUnit(\AppBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set moduleCn
     *
     * @param \AppBundle\Entity\ModuleCn $moduleCn
     *
     * @return Song
     */
    public function setModuleCn(\AppBundle\Entity\ModuleCn $moduleCn = null)
    {
        $this->moduleCn = $moduleCn;

        return $this;
    }

    /**
     * Get moduleCn
     *
     * @return \AppBundle\Entity\ModuleCn
     */
    public function getModuleCn()
    {
        return $this->moduleCn;
    }

    /**
     * Set moduleQu
     *
     * @param \AppBundle\Entity\ModuleQu $moduleQu
     *
     * @return Song
     */
    public function setModuleQu(\AppBundle\Entity\ModuleQu $moduleQu = null)
    {
        $this->moduleQu = $moduleQu;

        return $this;
    }

    /**
     * Get moduleQu
     *
     * @return \AppBundle\Entity\ModuleQu
     */
    public function getModuleQu()
    {
        return $this->moduleQu;
    }

    /**
     * Set moduleLt
     *
     * @param \AppBundle\Entity\ModuleLt $moduleLt
     *
     * @return Song
     */
    public function setModuleLt(\AppBundle\Entity\ModuleLt $moduleLt = null)
    {
        $this->moduleLt = $moduleLt;

        return $this;
    }

    /**
     * Get moduleLt
     *
     * @return \AppBundle\Entity\ModuleLt
     */
    public function getModuleLt()
    {
        return $this->moduleLt;
    }

    /**
     * Set moduleGe
     *
     * @param \AppBundle\Entity\ModuleGe $moduleGe
     *
     * @return Song
     */
    public function setModuleGe(\AppBundle\Entity\ModuleGe $moduleGe = null)
    {
        $this->moduleGe = $moduleGe;

        return $this;
    }

    /**
     * Get moduleGe
     *
     * @return \AppBundle\Entity\ModuleGe
     */
    public function getModuleGe()
    {
        return $this->moduleGe;
    }

    /**
     * Set moduleDw
     *
     * @param \AppBundle\Entity\ModuleDw $moduleDw
     *
     * @return Song
     */
    public function setModuleDw(\AppBundle\Entity\ModuleDw $moduleDw = null)
    {
        $this->moduleDw = $moduleDw;

        return $this;
    }

    /**
     * Get moduleDw
     *
     * @return \AppBundle\Entity\ModuleDw
     */
    public function getModuleDw()
    {
        return $this->moduleDw;
    }

    /**
     * Set moduleLs
     *
     * @param \AppBundle\Entity\ModuleLs $moduleLs
     *
     * @return Song
     */
    public function setModuleLs(\AppBundle\Entity\ModuleLs $moduleLs = null)
    {
        $this->moduleLs = $moduleLs;

        return $this;
    }

    /**
     * Get moduleLs
     *
     * @return \AppBundle\Entity\ModuleLs
     */
    public function getModuleLs()
    {
        return $this->moduleLs;
    }

    /**
     * Add medium
     *
     * @param \AppBundle\Entity\Media $medium
     *
     * @return Song
     */
    public function addMedia(\AppBundle\Entity\Media $medium)
    {
        $this->media[] = $medium;

        return $this;
    }

    /**
     * Remove medium
     *
     * @param \AppBundle\Entity\Media $medium
     */
    public function removeMedia(\AppBundle\Entity\Media $medium)
    {
        $this->media->removeElement($medium);
    }

    /**
     * Get media
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedia()
    {
        return $this->media;
    }
}
