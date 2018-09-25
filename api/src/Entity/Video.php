<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_video")
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 *
 * @ UniqueEntity(
 *     fields={"title","url"},
 *     message="This value '{{ value }}' is already used!"
 * )
 */
class Video
{
    /**
     * @var integer ID of the video
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Title of the video
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @var string Short description of the video
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $caption;

    /**
     * @var string URL of the video
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $url;

    /**
     * @var string External URL of the video
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $embedUrl;

    /**
     * @var integer Size of the video
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $size;

    /**
     * @var \DateTime Date of the upload on the server
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $uploadDate;

    /**
     * @var Image Thumbnail image for the video
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="video")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Image")
     */
    private $thumbnail;

    /**
     * @var Subject $subject
     * @ORM\OneToOne(targetEntity="Subject", cascade={"persist"}, mappedBy="video")     *
     * @Assert\Type("App\Entity\Subject")
     */
    private $subject;

    /**
     * @var Example Example associated to the video
     * @ORM\OneToOne(targetEntity="Example", mappedBy="video")
     * @ORM\JoinColumn(name="example_id", referencedColumnName="id", nullable=true)
     *
     * @Assert\Type("App\Entity\Example")
     */
    private $associatedExample;

    /**
     * @var Category $category Category associated to the video
     * @ORM\OneToOne(targetEntity="Category", mappedBy="video")
     * @Assert\Type("App\Entity\Category")
     */
    private $associatedCategory;

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
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     */
    public function setSubject(Subject $subject): void
    {
        $this->subject = $subject;
    }



    /**
     * @return Example|null
     */
    public function getAssociatedExample(): ?Example
    {
        return $this->associatedExample;
    }

    /**
     * @param Example|null $associatedExample
     * @return Video
     */
    public function setAssociatedExample(?Example $associatedExample): self
    {
        $this->associatedExample = $associatedExample;

        return $this;
    }



    /**
     * @return Category|null
     */
    public function getAssociatedCategory(): ?Category
    {
        return $this->associatedCategory;
    }

    /**
     * @param Category|null $associatedCategory
     * @return Video
     */
    public function setAssociatedCategory(?Category $associatedCategory): self
    {
        $this->associatedCategory = $associatedCategory;

        return $this;
    }


}
