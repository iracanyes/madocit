<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ApiResource()
 * @ORM\Table(name="mdit_subject")
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dependencies;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $proficiencyLevel;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @var Article Article associated to this subject
     *
     * @ORM\OneToOne(targetEntity="Article", cascade={"persist"},inversedBy="about")
     * @ORM\JoinColumn(nullable=true)
     */
    private $article;

    /**
     * @var Grain Grain associated to this subject
     *
     * @ORM\OneToOne(targetEntity="Grain", cascade={"persist"}, inversedBy="about")
     * @ORM\JoinColumn(nullable=true)
     */
    private $grain;

    /**
     * @var Editor $editor Editor who create this subject
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="subjectsCreated")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var Collection Subjects tackled by this subject
     * @ORM\ManyToMany(targetEntity="Subject", inversedBy="isPartOf" )
     * @ORM\JoinTable(
     *     name="mdit_purposes",
     *     joinColumns={@ORM\JoinColumn(name="has_part", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="is_part_of", referencedColumnName="id")}
     * )
     */
    private $hasPart;

    /**
     * @var Collection Subjects which tackle this subjects
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="hasPart")
     */
    private $isPartOf;



    /**
     * @var Collection Notes on the subject
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="subject")
     */
    private $notes;

    /**
     * @var Collection Contributions suggested on this subject
     *
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="subject")
     */
    private $contributionsSuggested;


    /**
     * @var Collection Chatroom of this subject
     *
     * @ORM\ManyToMany(targetEntity="Chat", cascade={"persist"}, inversedBy="subjects")
     * @ORM\JoinTable(name="chat_subjects")
     */
    private $chatrooms;

    /**
     * @var Version Theme's version which tackle the subject
     *
     * @ORM\ManyToOne(targetEntity="Version", cascade={"persist"}, inversedBy="subjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $version;

    /**
     * @var Collection Images illustrating the subject
     * @ORM\OneToMany(targetEntity="Image", mappedBy="subject")
     */
    private $images;

    /**
     * Subject constructor.
     */
    public function __construct()
    {
        $this->notes =
        $this->hasPart =
        $this->isPartOf =
        $this->contributionsSuggested =
        $this->chatrooms =
        $this->images  = new ArrayCollection();


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDependencies(): ?string
    {
        return $this->dependencies;
    }

    public function setDependencies(?string $dependencies): self
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    public function getProficiencyLevel(): ?string
    {
        return $this->proficiencyLevel;
    }

    public function setProficiencyLevel(?string $proficiencyLevel): self
    {
        $this->proficiencyLevel = $proficiencyLevel;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

    /**
     * @return Grain|null
     */
    public function getGrain(): ?Grain
    {
        return $this->grain;
    }

    /**
     * @param Grain $grain
     */
    public function setGrain(Grain $grain): void
    {
        $this->grain = $grain;
    }



    /**
     * @return Editor
     */
    public function getAuthor(): Editor
    {
        return $this->author;
    }

    /**
     * @param Editor $editor
     */
    public function setAuthor(Editor $editor): void
    {
        $this->author = $editor;
    }



    /**
     * @return Collection|null
     */
    public function getHasPart(): ?Collection
    {
        return $this->hasPart;
    }

    /**
     * Add a subject tackled
     *
     * @param Subject $subject
     * @return Subject
     */
    public function addHasPart(Subject $subject): self
    {
        if(!$this->hasPart->contains($subject)){

            // Add the subject tackled
            $this->hasPart->add($subject);

            if(!$subject->isPartOf->contains($this)){
                $subject->isPartOf->add($this);

            }
        }

        return $this;
    }

    /**
     * Remove a subject tackled
     *
     * @param Subject $subject
     * @return void
     */
    public function removeHasPart(Subject $subject): void
    {
        if($this->hasPart->contains($subject)){
            $this->hasPart->removeElement($subject);

            if($subject->isPartOf->contains($this)){
                $subject->isPartOf->removeElement($this);
            }

        }


    }

    /**
     * Get Subjects tackling this one
     * @return Collection|null
     */
    public function getIsPartOf(): ?Collection
    {
        return $this->isPartOf;
    }

    /**
     * Add a Subject tackling this one
     * @param Subject $subject
     * @return self
     */
    public function addIsPartOf(Subject $subject): self
    {
        if(!$this->isPartOf->contains($subject)){

            // Add a Subject tackling this one
            $this->isPartOf->add($subject);

            if($subject->hasPart->contains($this)){
                $subject->hasPart->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove a Subject tackling this one
     * @param Subject $subject
     * @return void
     */
    public function removeIsPartOf(Subject $subject):void
    {
        if($this->isPartOf->contains($subject)){

            // Remove a subject tackling this one
            $this->isPartOf->removeElement($subject);

            if($subject->hasPart->contains($this)){

                // Remove the reference to this one
                $subject->hasPart->removeElement($this);
            }
        }
    }

    /**
     * Get notes
     * @return Collection|null
     */
    public function getNotes(): ?Collection
    {
        return $this->notes;
    }

    /**
     * Add a Note
     *
     * @param Note $note
     * @return self
     */
    public function addNote(Note $note): self
    {
        if(!$this->notes->contains($note)){
            $this->notes->add($note);

            if($note->getSubject() === $this){
                $note->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove note on a subject
     *
     * @param Subject $subject
     * @return void
     */
    public function removeNote(Note $note): void
    {
        if($this->notes->contains($note)){
            $this->notes->removeElement($note);

            if($note->getSubject() === $this){
                $note->setSubject(null);
            }
        }
    }

    /**
     * Get contributions suggested
     *
     * @return Collection
     */
    public function getContributionsSuggested(): Collection
    {
        return $this->contributionsSuggested;
    }

    /**
     * Add a contribution suggested
     *
     * @param Contribution $contribution
     * @return self
     */
    public function addContributionSuggested(Contribution $contribution): self
    {
        if(!$this->contributionsSuggested->contains($contribution)){
            // Add a contribution
            $this->contributionsSuggested->add($contribution);

            if($contribution->getSubject() === $this){
                // Add a reference to this subject in contribution instance
                $contribution->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove a contribution made
     *
     * @param Contribution $contribution
     * @return void
     */
    public function removeContributionSuggested(Contribution $contribution): void
    {
        if($this->contributionsSuggested->contains($contribution)){
            // Remove a contribution
            $this->contributionsSuggested->add($contribution);

            if($contribution->getSubject() === $this){
                // Remove the reference to this subject
                $contribution->setSubject(null);
            }
        }
    }

    /**
     * Get chatrooms tackling this subject
     * @return Collection|null
     */
    public function getChatrooms(): ?Collection
    {
        return $this->chatrooms;
    }

    /**
     * Add a chatroom tackling this subject
     * @param Chat|null $chatroom
     * @return self
     */
    public function addChatroom(Chat $chatroom): self
    {
        if(!$this->chatrooms->contains($chatroom)){
            // Add a chatroom
            $this->chatrooms->add($chatroom);

            if($chatroom->getSubjects()->contains($this)){
                // Add a reference to this subject as tackled in the chatroom
                $chatroom->addSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom tackling this subject
     * @param Chat $chatroom
     * @return void
     */
    public function removeChatroom(Chat $chatroom):void
    {
        if($this->chatrooms->contains($chatroom)){
            // Remove the chatroom
            $this->chatrooms->removeElement($chatroom);

            if($this !== null && $chatroom->getSubjects()->contains($this)){
                // Remove the reference to this subject in the chatroom instance
                $chatroom->getSubjects()->removeElement($this);
            }
        }
    }

    /**
     * @return Version
     */
    public function getVersion(): Version
    {
        return $this->version;
    }

    /**
     * @param Version $version
     */
    public function setVersion(Version $version): void
    {
        $this->version = $version;
    }


    /**
     * Get Images
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * Add an image
     * @param Image $image;
     * @return Subject
     */
    public function addImage(Image $image): self
    {
        if(!$this->images->contains($image)){
            // Add an image
            $this->images->add($image);

            if($image->getSubject() !== $this){
                // Add a reference to the image
                $image->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove an image
     * @param Image $image
     * @return void
     */
    public function removeImage(Image $image): void
    {
        if($this->images->contains($image)){
            // Remove an image
            $this->images->removeElement($image);

            // Remove the reference to the subject
            if($image->getSubject() === $this){

                $image->setSubject(null);
            }
        }
    }
}
