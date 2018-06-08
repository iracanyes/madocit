<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @Assert\Image()
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
     * @ORM\OneToOne(targetEntity="User", mappedBy="image")
     * @Assert\Type("App\Entity\User")
     */
    private $user;

    /**
     * @var Category|null Category illustrated by the image
     * @ORM\OneToOne(targetEntity="Category",  mappedBy="image")
     * @Assert\Type("App\Entity\Category")
     */
    private $category;

    /**
     * @var Theme|null Theme illustrated by the image
     * @ORM\OneToOne(targetEntity="Theme",  mappedBy="image")
     * @Assert\Type("App\Entity\Theme")
     */
    private $theme;

    /**
     * @var Subject Subject illustrated bu the image
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist","remove"}, inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Subject")
     */
    private $subject;

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
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }



    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Theme|null
     */
    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme|null $theme
     */
    public function setTheme(?Theme $theme): void
    {
        $this->theme = $theme;
    }

    /**
     * @return Subject|null
     */
    public function getSubject(): ?Subject
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



}
