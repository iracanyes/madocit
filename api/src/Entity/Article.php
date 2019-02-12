<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article extends Subject
{
    /**
     * @var integer ID of the article
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * @var string Body of the article
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $articleBody;

    /**
     * @var \Datetime Date of creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var \Datetime The last modification's date of the article
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var \Datetime Date of publication
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $datePublished;

    /**
     * @var string Course prerequisites for a good understanding of the article
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type("string")
     */
    private $coursePrerequisites;

    /**
     * @var integer Aggregate rating received by other users.
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $aggregateRating;

    /**
     * @var string URI for the pdf of the given article.
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $pdf;

    /**
     * @var Collection $hasParts Grain included in this article
     * @ORM\ManyToMany(targetEntity="Grain", cascade={"persist"}, inversedBy="isPartOf")
     * @ORM\JoinTable(name="mdit_article_grains")
     * @Assert\Collection()
     */
    private $hasParts;




    public function __construct()
    {
        Subject::__construct();
        $this->hasParts = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleBody(): ?string
    {
        return $this->articleBody;
    }

    public function setArticleBody(string $articleBody): self
    {
        $this->articleBody = $articleBody;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateCreated(): ?\DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTime
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTime $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getDatePublished(): ?\DateTime
    {
        return $this->datePublished;
    }

    public function setDatePublished(?\DateTime $datePublished): self
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    public function getCoursePrerequisites(): ?string
    {
        return $this->coursePrerequisites;
    }

    public function setCoursePrerequisites(?string $coursePrerequisites): self
    {
        $this->coursePrerequisites = $coursePrerequisites;

        return $this;
    }

    public function getAggregateRating(): ?int
    {
        return $this->aggregateRating;
    }

    public function setAggregateRating(int $aggregateRating): self
    {
        $this->aggregateRating = $aggregateRating;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getHasParts(): ?Collection
    {
        return $this->hasParts;
    }

    /**
     * @param Grain $grain
     * @return Article
     */
    public function addHasPart(Grain $grain): Article
    {
        if(!$this->hasParts->contains($grain)){
            // Add the grain
            $this->hasParts->add($grain);

            // Add a reference to this article in the Grain entity
            if(!$grain->getIsPartOf()->contains($this)){

                $grain->getIsPartOf()->add($this);
            }

        }
        return $this;
    }

    /**
     * @param Grain $grain
     * @return self
     */
    public function removeHasPart(Grain $grain): self
    {
        if($this->hasParts->contains($grain)){
            // Remove the grain
            $this->hasParts->removeElement($grain);

            // Remove the reference to this Article in the Grain entity
            if($grain->getIsPartOf()->contains($this)){
                $grain->getIsPartOf()->removeElement($this);
            }
        }

        return $this;
    }
}
