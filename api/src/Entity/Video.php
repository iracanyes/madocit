<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_video")
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var integer ID of the video
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Title of the video
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $title;

    /**
     * @var string Short description of the video
     * @ORM\Column(type="text")
     */
    private $caption;

    /**
     * @var string URL of the video
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @var string External URL of the video
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $embedUrl;

    /**
     * @var integer Size of the video
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @var \DateTime Date of the upload on the server
     * @ORM\Column(type="datetime")
     */
    private $uploadDate;

    /**
     * @var Image Thumbnail image for the video
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="video")
     * @ORM\JoinColumn(nullable=true)
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

    /**
     * @return integer
     */
    public function getId(): int
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
     * @return Video
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return Video
     */
    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Video
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmbedUrl(): ?string
    {
        return $this->embedUrl;
    }

    /**
     * @param null|string $embedUrl
     * @return Video
     */
    public function setEmbedUrl(?string $embedUrl): self
    {
        $this->embedUrl = $embedUrl;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Video
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUploadDate(): ?\DateTimeInterface
    {
        return $this->uploadDate;
    }

    /**
     * @param \DateTimeInterface $uploadDate
     * @return Video
     */
    public function setUploadDate(\DateTimeInterface $uploadDate): self
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }


    /**
     * @return Image|null
     */
    public function getThumbnail(): ?Image
    {
        return $this->thumbnail;
    }

    /**
     * @param Image|null $thumbnail
     * @return Video
     */
    public function setThumbnail(?Image $thumbnail): self
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
