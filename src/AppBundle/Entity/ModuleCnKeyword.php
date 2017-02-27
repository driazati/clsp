<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleCnKeyword
 *
 * @ORM\Table(name="module_cn_keyword")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleCnKeywordRepository")
 */
class ModuleCnKeyword
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
     * @ORM\Column(type="string")
     */
    private $phrase;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $documentFile;

    /**
     * Many ModuleCnKeywords have One ModuleCn.
     * @ORM\ManyToOne(targetEntity="ModuleCn", inversedBy="keywords")
     * @ORM\JoinColumn(name="cn_id", referencedColumnName="id")
     */
    private $moduleCn;

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
     * Set phrase
     *
     * @param string $phrase
     *
     * @return ModuleCnKeyword
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * Get phrase
     *
     * @return string
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ModuleCnKeyword
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
     * Set link
     *
     * @param string $link
     *
     * @return ModuleCnKeyword
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set imageFile
     *
     * @param string $imageFile
     *
     * @return ModuleCnKeyword
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * Get imageFile
     *
     * @return string
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set documentFile
     *
     * @param string $documentFile
     *
     * @return ModuleCnKeyword
     */
    public function setDocumentFile($documentFile)
    {
        $this->documentFile = $documentFile;

        return $this;
    }

    /**
     * Get documentFile
     *
     * @return string
     */
    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    /**
     * Set moduleCn
     *
     * @param \AppBundle\Entity\ModuleCn $moduleCn
     *
     * @return ModuleCnKeyword
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
}
