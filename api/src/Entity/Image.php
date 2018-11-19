<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_image")
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * Validation des contraintes d'unicité des URL
 * @UniqueEntity("url")
 */
class Image
{
    /**
     * @var integer ID of the image
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var integer Place of the image (1-5).
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $place;

    /**
     * @var string Title of the image (optional)
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @var string URL of the image
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $url;

    /**
     * @var string Alternative title for the image (optional)
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $alt;

    /**
     * @var integer Size of the image
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $size;

    /**
     * @var User|null User represented by the image
     * @ORM\OneToOne(targetEntity="User", mappedBy="image")     *
     * @Assert\Type("App\Entity\User")
     */
    private $user;

    /**
     * @var Collection $categories Categories illustrated by this image
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="images")
     * @Assert\Collection()
     */
    private $categories;

    /**
     * @var Subject|null Subject illustrated bu the image
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist","remove"}, inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Subject")
     */
    private $subject;

    /**
     * @var Example|null $example Example illustrated by this image
     * @ORM\ManyToOne(targetEntity="Example", cascade={"persist","remove"}, inversedBy="images" )
     * @ORM\JoinColumn(nullable=true)
     */
    private $example;

    /**
     * @var Video|null $video Video illustrated by this image
     * @ORM\OneToOne(targetEntity="Video", mappedBy="thumbnail")
     * @Assert\Type("App\Entity\Video")
     */
    private $video;

    /**
     * Image constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

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

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }



    /**
     * @return Collection|null
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     * @return Image
     */
    public function addCategory(Category $category): self
    {
        if(!$this->categories->contains($category)){
            // Add a category
            $this->categories->add($category);

            if(!$category->getImages()->contains($this)){
                $category->addImage($this);
            }

        }

        return $this;
    }

    /**
     * Remove a category
     * @param Category $category
     * @return Image
     */
    public function removeCategory(Category $category): self
    {
        if($this->categories->contains($category)){
            // Remove
            $this->categories->removeElement($category);
        }
    }

    /**
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject|null $subject
     * @return Image
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Example|null
     */
    public function getExample(): ?Example
    {
        return $this->example;
    }

    /**
     * @param Example $example
     * @return Image
     */
    public function setExample(?Example $example): self
    {
        $this->example = $example;

        return $this;
    }

    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video|null $video
     * @return Image
     */
    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }





}
