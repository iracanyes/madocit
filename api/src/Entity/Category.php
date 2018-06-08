<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_category")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * Contraintes d'unicité des noms de catégorie
 * @UniqueEntity("name")
 */
class Category
{
    /**
     * @var integer ID of the category
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Name of the category
     * @ORM\Column(type="string", unique=true, length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string Description of the category
     * @ORM\Column(type="text")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var boolean The category has been validated
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $isValid;

    /**
     * @var Datetime Date of the creation of the category
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var Image|null Image illustrating the category
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="category")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Image")
     */
    private $image;

    /**
     * @var Collection Theme classified in the Category instance
     * @ORM\ManyToMany(targetEntity="Theme", cascade={"persist", "remove"}, inversedBy="categories")
     * @ORM\JoinTable(
     *     name="mdit_categories_themes",
     *     joinColumns={@ORM\JoinColumn(name="category_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="theme_id", nullable=false)}
     * )
     * @Assert\Collection()
     */
    private $themes;

    public function __construct()
    {
        $this->isValid = false;
        $this->themes = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

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

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     */
    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }



    /**
     * Get themes
     * @return Collection|null
     */
    public function getThemes(): ?Collection
    {
        return $this->themes;
    }

    /**
     * Add a theme
     * @param Theme $theme
     * @return Category
     */
    public function addTheme(Theme $theme): self
    {
        if(!$this->themes->contains($theme)){
            // Add a theme
            $this->themes->add($theme);

            if(!$theme->getCategories()->contains($this)){
                // Add a reference to the category
                $theme->addCategory($this);

            }
        }

        return $this;
    }

    /**
     * Remove a theme
     * @param Theme $theme
     * @return void
     */
    public function removeTheme(Theme $theme): void
    {
        if($this->themes->contains($theme)){
            // Remove the theme
            $this->themes->removeElement($theme);

            // Remove the reference to the category
            if($theme->getCategories()->contains($this)){
                $theme->getCategories()->removeElement($this);
            }
        }
    }
}
