<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     iri="http://schema.org/APIReference",
 * )
 * @ORM\Table(name="mdit_version")
 * @ORM\Entity(repositoryClass="App\Repository\VersionRepository")
 * @ UniqueEntity("assemblyVersion")
 */
class Version
{
    /**
     * @var integer ID of the version
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Associated product/technology version. e.g., .NET Framework 4.5.
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $assemblyVersion;

    /**
     * @var string Library file name e.g., mscorlib.dll, system.web.dll. Supersedes assembly.
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $executableLibraryName;

    /**
     * @var string Indicates whether API is managed or unmanaged.
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $programmingModel;

    /**
     * @var string Type of app development: phone, Metro style, desktop, XBox, etc.
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $targetPlatform;

    /**
     * @var boolean Version is validated
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $isValid;

    /**
     * @var \DateTime Date of creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var string Author of the version (optional)
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Type("string")
     */
    private $author;


    /**
     * @var Collection Subjects tackling this version
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="versions")
     * @Assert\Collection()
     */
    private $subjects;

    /**
     * @var Collection $chatrooms Chatrooms related to the version
     * @ORM\OneToMany(targetEntity="Chat", mappedBy="version")
     * @Assert\Collection()
     */
    private $chatrooms;

    /**
     * Version constructor.
     */
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->chatrooms = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getAssemblyVersion(): ?string
    {
        return $this->assemblyVersion;
    }

    /**
     * @param string $assemblyVersion
     * @return Version
     */
    public function setAssemblyVersion(string $assemblyVersion): self
    {
        $this->assemblyVersion = $assemblyVersion;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getExecutableLibraryName(): ?string
    {
        return $this->executableLibraryName;
    }

    /**
     * @param null|string $executableLibraryName
     * @return Version
     */
    public function setExecutableLibraryName(?string $executableLibraryName): self
    {
        $this->executableLibraryName = $executableLibraryName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getProgrammingModel(): ?string
    {
        return $this->programmingModel;
    }

    /**
     * @param null|string $programmingModel
     * @return Version
     */
    public function setProgrammingModel(?string $programmingModel): self
    {
        $this->programmingModel = $programmingModel;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTargetPlatform(): ?string
    {
        return $this->targetPlatform;
    }

    /**
     * @param null|string $targetPlatform
     * @return Version
     */
    public function setTargetPlatform(?string $targetPlatform): self
    {
        $this->targetPlatform = $targetPlatform;

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
     * @return Version
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
     * @return Version
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Version
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getSubjects(): ?Collection
    {
        return $this->subjects;
    }

    /**
     * Add a subject tackled in this version of the theme
     * @param Subject $subject
     * @return Version
     */
    public function addSubject(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)){
            // Add a subject
            $this->subjects->add($subject);

            if(!$subject->getVersions()->contains($this)){
                //Add a reference to this version in the Subject instance
                $subject->addVersion($this);
            }
        }

        return $this;
    }


    /**
     * Remove a subject tackled in this version of the theme
     * @param Subject $subject
     * @return self
     */
    public function removeSubject(Subject $subject): self
    {
        if($this->subjects->contains($subject)){
            // Remove a subject
            $this->subjects->removeElement($subject);

            if($subject->getVersions()->contains($this)){
                // Remove a reference to this version in the Subject instance
                $subject->removeVersion($this);
            }
        }

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getChatrooms(): ?Collection
    {
        return $this->chatrooms;
    }

    /**
     * Add a chatroom
     * @param Chat $chatroom
     * @return Version
     */
    public function addChatrooms(Chat $chatroom): self
    {
        if(!$this->chatrooms->contains($chatroom)){
            // Add the chatroom
            $this->chatrooms->add($chatroom);

            // Add the reference
            if($chatroom->getVersion() !== $this){
                $chatroom->setVersion($this);
            }
        }

        return $this;
    }


    /**
     * Remove a chatroom
     * @param Chat $chatroom
     * @return Version
     */
    public function removeChatrooms(Chat $chatroom): self
    {
        if($this->chatrooms->contains($chatroom)){
            // Remove the chatroom
            $this->chatrooms->add($chatroom);

            // Remove the reference
            if($chatroom->getVersion() === $this){
                $chatroom->setVersion(null);
            }
        }
    }

}
