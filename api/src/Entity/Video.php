<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $caption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $embedUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploadDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * @var Article Article associated to the video
     * @ORM\OneToOne(targetEntity="Article", cascade={"persist"}, inversedBy="video")
     * @ORM\JoinColumn(nullable=true)
     */
    private $associatedArticle;

    /**
     * @var Example Example associated to the video
     * @ORM\OneToOne(targetEntity="Example", cascade={"persist"}, inversedBy="video")
     * @ORM\JoinColumn(nullable=true)
     */
    private $associatedExample;

    /**
     * @var Grain Grain associated to the video
     * @ORM\OneToOne(targetEntity="Grain", cascade={"persist"}, inversedBy="video")
     * @ORM\JoinColumn(nullable=true)
     */
    private $associatedGrain;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEmbedUrl(): ?string
    {
        return $this->embedUrl;
    }

    public function setEmbedUrl(?string $embedUrl): self
    {
        $this->embedUrl = $embedUrl;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getUploadDate(): ?\DateTimeInterface
    {
        return $this->uploadDate;
    }

    public function setUploadDate(\DateTimeInterface $uploadDate): self
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Article|null
     */
    public function getAssociatedArticle(): ?Article
    {
        return $this->associatedArticle;
    }

    /**
     * @param Article $associatedArticle
     */
    public function setAssociatedArticle(Article $associatedArticle): void
    {
        $this->associatedArticle = $associatedArticle;
    }

    /**
     * @return Example|null
     */
    public function getAssociatedExample(): ?Example
    {
        return $this->associatedExample;
    }

    /**
     * @param Example $associatedExample
     */
    public function setAssociatedExample(Example $associatedExample): void
    {
        $this->associatedExample = $associatedExample;
    }

    /**
     * @return Grain|null
     */
    public function getAssociatedGrain(): ?Grain
    {
        return $this->associatedGrain;
    }

    /**
     * @param Grain $associatedGrain
     */
    public function setAssociatedGrain(Grain $associatedGrain): void
    {
        $this->associatedGrain = $associatedGrain;
    }


}
