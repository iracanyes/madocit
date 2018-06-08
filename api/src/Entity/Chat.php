<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_chat")
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 * @UniqueEntity("title")
 */
class Chat
{
    /**
     * @var integer ID of the chatroom
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Title of the chatroom
     * @ORM\Column(type="string", unique=true, length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string Status of the chatroom (active, open, ...)
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @var boolean The chatroom has been closed.
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type("boolean")
     * @Assert\NotBlank()
     */
    private $closed;

    /**
     * @var integer Negative vote for the chatroom
     * @ORM\Column(name="downvote_count", type="integer")
     * @Assert\Type("integer")
     */
    private $downvoteCount;

    /**
     * @var integer Positive vote for the chatroom
     * @ORM\Column(name="upvote_count", type="integer")
     * @Assert\Type("integer")
     */
    private $upvoteCount;

    /**
     * @var integer Aggregate rating for the chatroom
     * @ORM\Column(name="aggregate_rating", type="integer", nullable=true)
     * @Assert\Type("integer")
     */
    private $aggregateRating;

    /**
     * @var Editor $editor The creator of this chatroom
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="chatroomsCreated")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Editor")
     */
    private $creator;

    /**
     * @var Collection Subjects tackled in this chatroom
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="chatrooms")
     * @Assert\Collection()
     */
    private $subjects;

    /**
     * @var Collection $editorsInvolved Editors involved in this chatroom
     *
     * @ORM\ManyToMany(targetEntity="Editor", cascade={"persist"}, mappedBy="chatroomsInvolved")
     * @Assert\Collection()
     */
    private $editorsInvolved;


    /**
     * Abuses on this chat
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="chat")
     * @Assert\Collection()
     */
    private $abuses;

    public function __construct()
    {
        $this->abuses = $this->subjects = $this->editorsInvolved = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(?bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getDownvoteCount(): ?int
    {
        return $this->downvoteCount;
    }

    public function setDownvoteCount(int $downvoteCount): self
    {
        $this->downvoteCount = $downvoteCount;

        return $this;
    }

    public function getUpvoteCount(): ?int
    {
        return $this->upvoteCount;
    }

    public function setUpvoteCount(int $upvoteCount): self
    {
        $this->upvoteCount = $upvoteCount;

        return $this;
    }

    public function getAggregateRating(): ?int
    {
        return $this->aggregateRating;
    }

    public function setAggregateRating(?int $aggregateRating): self
    {
        $this->aggregateRating = $aggregateRating;

        return $this;
    }

    /**
     * @return Editor
     */
    public function getCreator(): Editor
    {
        return $this->creator;
    }

    /**
     * @param Editor $creator
     */
    public function setCreator(Editor $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * Get subjects tackled in this chatroom
     *
     * @return Collection|null
     */
    public function getSubjects(): ?Collection
    {
        return $this->subjects;
    }

    /**
     * Add a subjects tackled in this chatroom
     *
     * @param Subject $subject
     * @return self
     */
    public function addSubject(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)){
            // Add a subject
            $this->subjects->add($subject);

            if($subject->getChatrooms()->contains($this)){
                // Add a reference to this chatroom
                $subject->getChatrooms()->add($this);
            }

        }

        return $this;
    }

    /**
     * Remove a subject tackled in this chatroom
     *
     * @param Subject $subject
     * @return void
     */
    public function removeSubject(Subject $subject): void
    {
        if($this->subjects->contains($subject)){
            // Remove a subject
            $this->subjects->removeElement($subject);

            if($subject->getChatrooms()->contains($this)){
                // Remove the reference to this chat
                $subject->getChatrooms()->removeElement($this);
            }
        }
    }

    /**
     * Get editors involved
     *
     * @return Collection|null
     */
    public function getEditorsInvolved(): ?Collection
    {
        return $this->editorsInvolved;
    }

    /**
     * Add an editor involved
     *
     * @param Editor $editor
     * @return self
     */
    public function addEditorInvolved(Editor $editor): self
    {
        if(!$this->editorsInvolved->contains($editor)){
            // Add an editor
            $this->editorsInvolved->add($editor);

            if(!$editor->getChatroomsInvolved()->contains($this)){
                // Add a reference as involved in this chatroom to the editor
                $editor->getChatroomsInvolved()->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove an editor involved
     *
     * @param Editor $editor
     * @return void
     */
    public function removeEditorInvolved(Editor $editor): void
    {
        if($this->editorsInvolved->contains($editor)){
            // Remove an editor involved
            $this->editorsInvolved->removeElement($editor);

            if($editor->getChatroomsInvolved()->contains($this)){
                //Remove the reference to this chatroom in the editor instance
                $editor->getChatroomsInvolved()->removeElement($this);
            }
        }
    }

    /**
     * Get abuses
     *
     * @return Collection|null
     */
    public function getAbuses(): ?Collection
    {
        return $this->abuses;
    }

    /**
     * Add an abuse on the chatroom
     *
     * @param Abuse $abuse
     * @return self
     */
    public function addAbuse(Abuse $abuse): self
    {
        if(!$this->abuses->contains($abuse)){
            $this->abuses->add($abuse);

            $abuse->setChat($this);
        }


        return $this;
    }

    /**
     * Remove an abuse
     *
     * @param Abuse $abuse
     * @return void
     */
    public function removeAbuse(Abuse $abuse): void
    {
        if($this->abuses->contains($abuse)){
            $this->abuses->removeElement($abuse);

            if($abuse->getChat() === $this){
                $abuse->setChat(null);
            }
        }

    }



}
