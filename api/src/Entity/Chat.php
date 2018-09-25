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
 * @ UniqueEntity("title")
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
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Title of the chatroom
     * @ORM\Column(type="string", length=255)
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
     * @Assert\NotNull()
     */
    private $creator;

    /**
     * @var Collection $chatEditors Chat's editors
     * @ORM\OneToMany(targetEntity="App\Entity\EditorsChats", mappedBy="chatroom")
     * @Assert\Collection()
     */
    private $chatEditors;

    /**
     * @var Subject $subject Subjects tackled in this chatroom
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"}, inversedBy="chatrooms")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Subject")
     */
    private $subject;

    /**
     * @var Version|null $version Version tackled in this chatroom
     * @ORM\ManyToOne(targetEntity="Version", cascade={"persist"}, inversedBy="chatrooms")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Version")
     */
    private $version;

    /**
     * @var Theme $theme Theme tackled in this chatroom
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"}, inversedBy="chatrooms")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Theme")
     */
    private $theme;



    /**
     * @var Category $category Category tackled in this chatroom
     * @ORM\ManyToOne(targetEntity="Category", cascade={"persist"}, inversedBy="chatrooms")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;


    /**
     * @var Collection $messages
     * @ORM\OneToMany(targetEntity="Message", mappedBy="chatroom")
     *
     * @Assert\Collection()
     */
    private $messages;


    public function __construct()
    {
        $this->chatEditors = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * @return Editor|null
     */
    public function getCreator(): ?Editor
    {
        return $this->creator;
    }

    /**
     * @param Editor|null $creator
     * @return Chat
     */
    public function setCreator(?Editor $creator): self
    {
        $this->creator = $creator;

        if(!is_null($creator) && !$creator->getChatroomsCreated()->contains($this)){
            $creator->addChatroomsCreated($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChatEditors(): Collection
    {
        return $this->chatEditors;
    }

    /**
     * @param EditorsChats $chatEditor
     * @return self
     */
    public function addChatEditors(EditorsChats $chatEditor): self
    {
        if(!$this->chatEditors->contains($chatEditor)){
            // Add a chat's editor
            $this->chatEditors->add($chatEditor);

            if($chatEditor->getChatroom() !== $this){
                $chatEditor->setChatroom($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chat's editor
     *
     * @param EditorsChats $chatEditor
     * @return Chat
     */
    public function removeChatEditors(EditorsChats $chatEditor): self
    {
        if($this->chatEditors->contains($chatEditor)){
            // Remove
            $this->chatEditors->removeElement($chatEditor);

            // Remove the reference to this chat
            if($chatEditor->getChatroom() === $this){
                $chatEditor->setChatroom(null);
            }
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
     * @return Chat
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Version|null
     */
    public function getVersion(): ?Version
    {
        return $this->version;
    }

    /**
     * @param Version|null $version
     * @return Chat
     */
    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Theme|null
     */
    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme|null $theme
     * @return Chat
     */
    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Chat
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        if(!is_null($category) && !$category->getChatrooms()->contains($this)){
            $category->addChatroom($this);
        }

        return $this;
    }


    /**
     * Get messages
     *
     * @return Collection
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    /**
     * Add a message
     * @param Message $message
     * @return Chat
     */
    public function addMessage(Message $message): self
    {
        if(!$this->messages->contains($message)){
            // Add the message
            $this->messages->add($message);

            // Add a reference to this chat in the Message instance
            if($message->getChatroom() !== $this){
                $message->setChatroom($this);
            }
        }

        return $this;
    }

    /**
     * Remove a message
     * @param Message $message
     * @return void
     */
    public function removeMessage(Message $message): void
    {
        if($this->messages->contains($message)){
            // Remove the message
            $this->messages->removeElement($message);

            // Remove the reference to this Chat in the Message instance
            if($message->getChatroom() === $this){
                $message->setChatroom(null);
            }
        }
    }

}
