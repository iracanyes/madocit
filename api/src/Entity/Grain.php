<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_grain")
 * @ORM\Entity(repositoryClass="App\Repository\GrainRepository")
 */
class Grain
{
    /**
     * @var integer ID of the grain (piece of article)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Content of the grain (piece of article)
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var \Datetime Date of the creation
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime Date of the last modification
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @var \DateTime Date of the publication
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublished;

    /**
     * @var boolean The grain is a draft
     * @ORM\Column(type="boolean")
     */
    private $draft;

    /**
     * @var Subject Subject matter of the content
     *
     * @ORM\OneToOne(targetEntity="Subject", mappedBy="grain")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", nullable=true)
     */
    private $about;

    /**
     * @var Collection Associated examples
     *
     * @ORM\ManyToMany(targetEntity="Example", mappedBy="associatedGrains")
     */
    private $associatedExamples;

    /**
     * @var Video Video associated to the grain
     *
     * @ORM\OneToOne(targetEntity="Video", cascade={"persist"}, mappedBy="associatedGrain")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", nullable=true)
     */
    private $video;

    public function __construct()
    {
        $this->associatedExamples = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

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
     * @return Grain
     */
    public function addAssociatedExample(Example $example): self
    {
        if(!$this->associatedExamples->contains($example)){
            // Add an example
            $this->associatedExamples->add($example);

            if(!$example->getAssociatedGrains()->contains($this)){
                // Add the reference to this editor in the Example instance
                $example->getAssociatedGrains()->add($this);
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

            if($example->getAssociatedGrains()->contains($this)){
                // Remove the reference
                $example->getAssociatedGrains()->removeElement($this);
            }
        }
    }

    /**
     * @return Video
     */
    public function getVideo(): Video
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
