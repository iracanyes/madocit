<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ExampleRepository")
 */
class Example
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var Collection Articles associated to the example
     *
     * @ORM\ManyToMany(targetEntity="Article", cascade={"persist"}, inversedBy="associatedExamples")
     * @ORM\JoinTable(name="mdit_article_examples")
     */
    private $associatedArticles;

    /**
     * @var Collection Articles associated to the example
     *
     * @ORM\ManyToMany(targetEntity="Grain", cascade={"persist"}, inversedBy="associatedExamples")
     * @ORM\JoinTable(name="mdit_grain_examples")
     */
    private $associatedGrains;

    /**
     * @var Video Video associated to the example
     *
     * @ORM\OneToOne(targetEntity="Video", mappedBy="associatedExample")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", nullable=true)
     */
    private $video;

    /**
     * Example constructor.
     */
    public function __construct()
    {
        $this->associatedArticles = $this->associatedGrains = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Example
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Example
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return Example
     */
    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTimeInterface $dateCreated
     * @return Example
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param \DateTimeInterface|null $dateModified
     * @return Example
     */
    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    /**
     * @param null|string $pdf
     * @return Example
     */
    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get articles associated to the example
     * @return Collection
     */
    public function getAssociatedArticles(): Collection
    {
        return $this->associatedArticles;
    }

    /**
     * Add an associated article
     *
     * @param Article $article
     * @return self
     */
    public function addAssociatedArticle(Article $article): self
    {
        if(!$this->associatedArticles->contains($article)){
            // Add an article
            $this->associatedArticles->add($article);

            // Add the reference to this example in the Article instance
            if($article->getAssociatedExamples()->contains($this)){

                $article->addAssociatedExample($this);
            }
        }

        return $this;

    }

    /**
     * Remove an associated article
     * @param Article $article
     * @return void
     */
    public function removeAssociatedArticle(Article $article): void
    {
        if($this->associatedArticles->contains($article)){
            // Remove the article
            $this->associatedArticles->removeElement($article);

            // Remove the reference to this example in the Article instance
            if($article->getAssociatedExamples()->contains($this)){

                $article->getAssociatedExamples()->removeElement($this);
            }
        }
    }

    /**
     * Get Associated grains
     *
     * @return Collection
     */
    public function getAssociatedGrains(): Collection
    {
        return $this->associatedGrains;
    }

    /**
     * Add an associated grain
     *
     * @param Grain $grain
     * @return Example
     */
    public function addAssociatedGrain(Grain $grain): self
    {
        if(!$this->associatedGrains->contains($grain)){
            // Add an associated grain
            $this->associatedGrains->add($grain);

            if($grain->getAssociatedExamples()->contains($this)){
                // Remove the reference to the example in the Grain instance
                $grain->getAssociatedExamples()->removeElement($this);
            }
        }
    }

    /**
     * Remove an associated grain
     * @param Grain $grain
     * @return void
     */
    public function removeAssociatedGrain(Grain $grain): void
    {
        if($this->associatedGrains->contains($grain)){
            // Remove the grain
            $this->associatedGrains->removeElement($grain);

            if($grain->getAssociatedExamples->contains($this)){
                // Remove the reference to the example in the Grain instance
                $grain->getAssociatedExamples()->removeElement($this);
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
