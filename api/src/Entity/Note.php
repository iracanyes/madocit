<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_note")
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;


    /**
     *
     * @var Editor $editor Editor who created the note
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="notesSuggested")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;

    /**
     * @var Moderator $moderator A moderator validate notes shown on the page
     *
     * @ORM\ManyToOne(targetEntity="Moderator", cascade={"persist"}, inversedBy="notesValidated")
     * @ORM\JoinColumn(nullable=false)
     */
    private $moderator;

    /**
     * @var Subject A subject which is annotated
     *
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"}, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
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
     * @param Editor $editor
     */
    public function setEditor(Editor $editor): void
    {
        $this->editor = $editor;
    }

    /**
     * @return Moderator
     */
    public function getModerator(): Moderator
    {
        return $this->moderator;
    }

    /**
     * @param Moderator $moderator
     */
    public function setModerator(Moderator $moderator): void
    {
        $this->moderator = $moderator;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
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
