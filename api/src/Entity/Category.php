<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Name of the category
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string $resume Resume of the category's description
     * @ORM\Column(name="resume", type="text")
     * @Assert\Type("string")
     */
    private $resume;

    /**
     * @var string Description of the category
     * @ORM\Column(name="description", type="text")
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
     *
     * @var \DateTime Date of the creation of the category
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var Category|null $parentCategory Parent category of this category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subCategories")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     *
     */
    private $parentCategory;

    /**
     * @var ArrayCollection $subCategories SubCategories related to the category
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parentCategory")
     * @Assert\Collection()
     */
    private $subCategories;



    /**
     * @var Collection $subjects Subjects classified in this category
     * @ORM\ManyToMany(targetEntity="Subject", cascade={"persist"} ,inversedBy="categories")
     * @ORM\JoinTable(name="mdit_category_subjects")
     * @Assert\Collection()
     */
    private $subjects;


    /**
     * @var Collection $images Images illustrating the category
     * @ORM\ManyToMany(targetEntity="Image", cascade={"persist"}, inversedBy="categories")
     * @ORM\JoinTable(name="mdit_categories_images")
     *
     * @Assert\Collection()
     */
    private $images;


    /**
     * @var Video $video Video that describe the category
     * @ORM\OneToOne(targetEntity="Video", cascade={"persist","remove"}, inversedBy="associatedCategory")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Video")
     */
    private $video;

    /**
     * @var Collection $chatrooms Chatrooms related to the category
     * @ORM\OneToMany(targetEntity="Chat", mappedBy="category")
     * @Assert\Collection()
     */
    private $chatrooms;

    /**
     * Category constructor.
     */
    public function __construct()
    {

        $this->isValid = false;
        $this->subCategories = new ArrayCollection();
        $this->subjects = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->chatrooms = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getResume(): ?string
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     * @return Category
     */
    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }


    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Category
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     * @return Category
     */
    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

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
     * @return Category
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getParentCategory(): ?Category
    {
        return $this->parentCategory;
    }

    /**
     * @param Category|null $parentCategory
     * @return Category
     */
    public function setParentCategory(?Category $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        if(($parentCategory !== null) && !$parentCategory->getSubCategories()->contains($this)){
            $parentCategory->addSubCategories($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSubCategories(): ?Collection
    {
        return $this->subCategories;
    }

    public function setSubCategories(ArrayCollection $collection): self
    {
        $this->subCategories = $collection;

        return $this;
    }

    /**
     * @param Category|null $category
     * @return Category
     */
    public function addSubCategory(?Category $category = null): self
    {
        if(!$this->subCategories->contains($category)){
            $this->subCategories->add($category);

            if($category->getParentCategory() !== $this){
                $category->setParentCategory($this);
            }
        }

        return $this;
    }

    /**
     * Remove a sub-category
     * @param Category $category
     * @return Category
     */
    public function removeSubCategory(Category $category): self
    {
        if($this->subCategories->contains($category)){
            $this->subCategories->removeElement($category);

            if($category->getParentCategory() === $this){
                $category->setParentCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    /**
     * @param Collection $collection
     * @return Category
     */
    public function setSubjects(Collection $collection): self
    {
        $this->subjects = $collection;

        return $this;
    }

    /**
     * @param Subject $subject
     * @return Category
     */
    public function addSubjects(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)) {
            // Add a subject
            $this->subjects->add($subject);

            if($subject->getCategories()->contains($this)){
                $subject->getCategories()->removeElement($this);
            }
        }

        return $this;
    }

    /**
     * Remove a subject
     *
     * @param Subject $subject
     * @return Category
     */
    public function removeSubjects(Subject $subject): self
    {
        if($this->subjects->contains($subject)){
            // Remove the subject
            $this->subjects->removeElement($subject);

            if($subject->getCategories()->contains($this)){
                $subject->getCategories()->removeElement($this);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     * @return Category
     */
    public function addImage(Image $image): self
    {
        if(!$this->images->contains($image)){
            $this->images->add($image);

            if(!$image->getCategories()->contains($this)){
                $image->addCategory($this);
            }
        }

        return $this;
    }

    /**
     * Remove an image
     * @param Image $image
     * @return Category
     */
    public function removeImage(Image $image): self
    {
        if($this->images->contains($image)){
            $this->images->removeElement($image);

            if($image->getCategories()->contains($this)){
                $image->removeCategory($this);
            }
        }

        return $this;
    }


    /**
     * @return Video
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return Category
     */
    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChatrooms(): Collection
    {
        return $this->chatrooms;
    }

    /**
     * @param Collection $collection
     * @return Category
     */
    public function setChatrooms(Collection $collection): self
    {
        $this->chatrooms = $collection;

        return $this;
    }

    /**
     * Add a chatroom
     * @param Chat $chatroom
     * @return Category
     */
    public function addChatroom(Chat $chatroom): self
    {
        if(!$this->chatrooms->contains($chatroom)){
            $this->chatrooms->add($chatroom);

            if($chatroom->getCategory() !== $this){
                $chatroom->setCategory($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom
     * @param Chat $chatroom
     * @return Category
     */
    public function removeChatroom(Chat $chatroom): self
    {
        if($this->chatrooms->contains($chatroom)){
            // Remove a chatroom
            $this->chatrooms->removeElement($chatroom);

            // Remove the reference
            if($chatroom->getCategory() === $this){
                $chatroom->setCategory(null);
            }
        }

        return $this;
    }

}
