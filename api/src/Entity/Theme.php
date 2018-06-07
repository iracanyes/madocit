<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_theme")
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 */
class Theme
{
    /**
     * @var integer ID of the theme
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Name of the theme
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $name;

    /**
     * @var string Description of the theme
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var boolean The theme has been validated
     * @ORM\Column(type="boolean")
     */
    private $isValid;

    /**
     * @var \DateTime Date of the creation
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var Image|null Image illustrating the category
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="theme")
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @var Collection Categories of the theme
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="themes")
     */
    private $categories;

    /**
     * @var Collection Versions of the theme
     * @ORM\OneToMany(targetEntity="Version", mappedBy="theme")
     */
    private $versions;



    public function __construct()
    {
        $this->categories = $this->versions = new ArrayCollection();
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
     * Get categories
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * Add a category
     * @param Category $category
     * @return Theme
     */
    public function addCategory(Category $category): self
    {
        if(!$this->categories->contains($category)){
            // Add a version
            $this->categories->add($category);

            // Add a reference to this theme in the Version instance
            if(!$category->getThemes()->contains($this)){

                $category->getThemes()->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove a category
     * @param Category $category
     * @return void
     */
    public function removeCategory(Category $category): void
    {
        if($this->categories->contains($category)){
            // Remove a version
            $this->categories->removeElement($category);

            // Remove a reference to this theme in the Version instance
            if($category->getThemes()->contains($this)){

                $category->getThemes()->removeElement($this);
            }
        }
    }

    /**
     * Get all versions of this theme
     * @return Collection
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    /**
     * Add a version of this theme
     * @param Version $version
     * @return Theme
     */
    public function addVersion(Version $version): self
    {
        if(!$this->versions->contains($version)){
            // Add a version
            $this->versions->add($version);

            // Add a reference to this theme in the Version instance
            if($version->getTheme() !== $this){

                $version->setTheme($this);
            }
        }

        return $this;
    }

    /**
     * Remove a version of this theme
     * @param Version $version
     * @return void
     */
    public function removeVersion(Version $version): void
    {
        if($this->versions->contains($version)){
            // Remove a version
            $this->versions->removeElement($version);

            if($version->getTheme() === $this){
                // Remove the referene to this Theme instance in the Version instance
                $version->setTheme(null);
            }
        }
    }
}
