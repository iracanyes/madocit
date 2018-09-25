<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_grain")
 * @ORM\Entity(repositoryClass="App\Repository\GrainRepository")
 */
class Grain extends Subject
{
    /**
     * @var integer ID of the grain (piece of article)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     *
     */
    protected $id;

    /**
     * @var string Content of the grain (piece of article)
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \Datetime Date of the creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var \DateTime Date of the last modification
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var \DateTime Date of the publication
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $datePublished;

    /**
     * @var boolean The grain is a draft
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $draft;

    /**
     * @var integer Average votes made by other users
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min=0,
     *     max=5,
     *     minMessage="The minimumm rate for vote is {{ limit }}. \n Your rate's value is {{ value }} !",
     *     maxMessage="The maximumm rate for vote is {{ limit }}. \n Your rate's value is {{ value }} !"
     * )
     */
    private $rating;


    /**
     * @var Collection $isPartOf Article in which this grain is included
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="hasParts")
     * @Assert\Collection()
     */
    private $isPartOf;

    public function __construct()
    {
        Subject::__construct();
        $this->isPartOf = new ArrayCollection();
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
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return Collection
     */
    public function getIsPartOf(): Collection
    {
        return $this->isPartOf;
    }

    /**
     * @param Article $article
     * @return self
     */
    public function addIsPartOf(Article $article): self
    {
        if(!$this->isPartOf->contains($article)){
            // Add the article
            $this->isPartOf->add($article);

            /* Add a reference to this Grain in the Article instance
            if(!$article->getHasPart()->contains($this)){
                $article->addHasPart($this);
            }
            */
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return self
     */
    public function removeIsPartOf(Article $article): self
    {
        if($this->isPartOf->contains($article)){
            // Remove the article
            $this->isPartOf->removeElement($article);

            /* Remove the reference to this grain in the Article instance
            if($article->getHasPart()->contains($this)){
                $article->getHasPart()->removeElement($this);
            }
            */
        }

        return $this;
    }
}
