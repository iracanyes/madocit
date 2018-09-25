<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_note")
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @var integer ID of the note
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Content of the note
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \DateTime Date of creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var \DateTime Date of the last modification
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var integer Average rating for the note
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $rating;

    /**
     * @var boolean Note is validated
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type("boolean")
     */
    private $isValid;


    /**
     *
     * @var Editor $editor Editor who created the note
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="notesSuggested")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $editor;

    /**
     * @var Moderator $moderator A moderator validate notes shown on the page
     *
     * @ORM\ManyToOne(targetEntity="Moderator", cascade={"persist"}, inversedBy="notesValidated")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Moderator")
     *
     */
    private $moderator;

    /**
     * @var Subject A subject which is annotated
     *
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"}, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Subject")
     */
    private $subject;


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    /**
     * @param bool|null $isValid
     * @return Note
     */
    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @return Editor|null
     */
    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    /**
     * @param Editor|null $editor
     * @return Note
     */
    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        if(!is_null($editor) && !$editor->getNotesSuggested()->contains($this)){
            $editor->addNoteSuggested($this);
        }

        return $this;
    }

    /**
     * @return Moderator|null
     */
    public function getModerator(): ?Moderator
    {
        return $this->moderator;
    }

    /**
     * @param Moderator|null $moderator
     * @return Note
     */
    public function setModerator(?Moderator $moderator): self
    {
        $this->moderator = $moderator;

        if(!is_null($moderator) && !$moderator->getNotesValidated()->contains($this)){
            $moderator->addNotesValidated($this);
        }

        return $this;
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
     * @return Note
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        if(($subject !== null) && !$subject->getNotes()->contains($this)){
            $subject->addNote($this);
        }

        return $this;
    }


}
