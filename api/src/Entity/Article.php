<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var integer ID of the article
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Body of the article
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $articleBody;

    /**
     * @var Datetime Creation's date of the article
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var Datetime The last modification's date of the article
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var Datetime Date of publication
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
     * @Assert\File(
     *     maxSize = "20M",
     *     binaryFormat = {"application/pdf", "application/x-pdf"},
     *     mimeTypes = "Please upload a valid PDF",
     *     maxSizeMessage="The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}",
     *     mimeTypesMessage="The mime type of the file is invalid ({{ type }}). Allowed mime types are {{ types }}"
     * )
     */
    private $pdf;

    /**
     * @var Subject Subject matter of this article
     *
     * @ORM\OneToOne(targetEntity="Subject", mappedBy="article")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     * @Assert\Type("App\Entity\Subject")
     * @Assert\NotNull()
     */
    private $about;

    /**
     * @var Video Video associated to the article
     *
     * @ORM\OneToOne(targetEntity="Video", mappedBy="associatedArticle")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", nullable=true)
     * @Assert\Type("App\Entity\Video")
     */
    private $video;

    /**
     * @var Collection Examples associated to the article
     * @ORM\ManyToMany(targetEntity="Example", mappedBy="associatedArticles")
     * @Assert\Collection()
     */
    private $associatedExamples;

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

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getDatePublished(): ?\DateTimeInterface
    {
        return $this->datePublished;
    }

    public function setDatePublished(?\DateTimeInterface $datePublished): self
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
     * @return Subject
     */
    public function getAbout(): Subject
    {
        return $this->about;
    }

    /**
     * @param Subject $about
     */
    public function setAbout(Subject $about): void
    {
        $this->about = $about;
    }

    /**
     * Get associated examples
     *
     * @return Collection
     */
    public function getAssociatedExamples(): Collection
    {
        return $this->associatedExamples;
    }

    /**
     * Add an associated example
     *
     * @param Example $example
     * @return Article
     */
    public function addAssociatedExample(Example $example): self
    {
        if(!$this->associatedExamples->contains($example)){
            // Add an example
            $this->associatedExamples->add($example);

            if(!$example->getAssociatedArticles()->contains($this)){
                // Add the reference to this editor in the Example instance
                $example->getAssociatedArticles()->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove an associated example
     *
     * @param Example $example
     * @return void
     */
    public function removeAssociatedExample(Example $example): void
    {
        if($this->associatedExamples->contains($example)){
            // Remove an associated example
            $this->associatedExamples->removeElement($example);

            if($example->getAssociatedArticles()->contains($this)){
                // Remove the reference
                $example->getAssociatedArticles()->removeElement($this);
            }
        }
    }

    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     */
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }


}
