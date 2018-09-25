<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_theme")
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 * @ UniqueEntity("name")
 */
class Theme
{
    /**
     * @var integer ID of the theme
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Name of the theme
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @var string Description of the theme
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var boolean The theme has been validated
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $isValid;

    /**
     * @var \DateTime Date of the creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var Collection $subjects Subjects evoking this theme
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="themes")
     */
    private $subjects;

    /**
     * @var Collection $chatrooms Chatrooms related to the theme
     * @ORM\OneToMany(targetEntity="Chat", mappedBy="theme")
     * @Assert\Collection()
     */
    private $chatrooms;

    /**
     * Theme constructor.
     */
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->chatrooms = new ArrayCollection();
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
     * @return Collection
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    /**
     * @param Subject $subject
     * @return Theme
     */
    public function addSubject(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)){
            $this->subjects->add($subject);

        }

        return $this;
    }

    /**
     * Remove a subject
     * @param Subject $subject
     * @return Theme
     */
    public function removeSubject(Subject $subject): self
    {
        if($this->subjects->contains($subject)){
            // remove
            $this->subjects->removeElement($subject);
        }

        return $this;
    }


    /**
     * Get chatrooms
     * @return Collection
     */
    public function getChatrooms(): Collection
    {
        return $this->chatrooms;
    }

    /**
     * Add a chatroom
     * @param Collection $chatrooms
     */
    public function addChatrooms(Chat $chatroom): self
    {
        if(!$this->chatrooms->contains($chatroom)){
            $this->chatrooms->add($chatroom);

            if($chatroom->getTheme() !== $this){
                $chatroom->setTheme($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom
     * @param Chat $chatroom
     * @return Theme
     */
    public function removeChatrooms(Chat $chatroom): self
    {
        if($this->chatrooms->contains($chatroom)){

            $this->chatrooms->removeElement($chatroom);

            if($chatroom->getTheme() === $this){

                $chatroom->setTheme(null);
            }
        }

        return $this;
    }


}
