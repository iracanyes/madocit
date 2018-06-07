<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_version")
 * @ORM\Entity(repositoryClass="App\Repository\VersionRepository")
 */
class Version
{
    /**
     * @var integer ID of the version
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Associated product/technology version. e.g., .NET Framework 4.5.
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $assemblyVersion;

    /**
     * @var string Library file name e.g., mscorlib.dll, system.web.dll. Supersedes assembly.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $executableLibraryName;

    /**
     * @var string Indicates whether API is managed or unmanaged.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $programmingModel;

    /**
     * @var string Type of app development: phone, Metro style, desktop, XBox, etc.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $targetPlatform;

    /**
     * @var boolean Version is validated
     * @ORM\Column(type="boolean")
     */
    private $isValid;

    /**
     * @var \DateTime Date of creation
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var string Author of the version (optional)
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @var Theme Theme associated with this version
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist", "remove"}, inversedBy="versions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    /**
     * @var Collection Subjects tackling this version of the theme
     * @ORM\OneToMany(targetEntity="Subject", cascade={"persist"}, mappedBy="version")
     */
    private $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
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
     * Get Theme
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * Set theme
     * @param Theme $theme
     * @return Version
     */
    public function setTheme(Theme $theme): self
    {
        $this->theme = $theme;

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
     * Add a subject tackled in this version of the theme
     * @param Subject $subject
     * @return Version
     */
    public function addSubject(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)){
            // Add a subject
            $this->subjects->add($subject);

            if(!$subject->getVersion() === $this){
                //Add a reference to this version in the Subject instance
                $subject->setVersion($this);
            }
        }

        return $this;
    }


    /**
     * Remove a subject tackled in this version of the theme
     * @param Subject $subject
     * @return void
     */
    public function removeSubject(Subject $subject): void
    {
        if($this->subjects->contains($subject)){
            // Remove a subject
            $this->subjects->removeElement($subject);

            if($subject->getVersion() === $this){
                // Remove a reference to this version in the Subject instance
                $subject->setVersion(null);
            }
        }
    }


}
