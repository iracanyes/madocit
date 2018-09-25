<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_message")
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int $id ID of the message
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $content Content of the message
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \Datetime $dateCreated Date of the message's creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var boolean $sanctioned The message is an abuse
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $sanctioned;

    /**
     * @var int $downvoteCount Negative vote for the message
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $downvoteCount;

    /**
     * @var int $upvoteCount Positive vote for the message
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $upvoteCount;

    /**
     * @var string $attachmentFile File attached to the message
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $attachmentFile;

    /**
     * @var string $attachmentImage Image attached to the message
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $attachmentImage;

    /**
     * @var string $attachmentUrl URL attached to the message
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $attachmentUrl;

    /**
     * @var Editor $editor Editor who created the message
     * @ORM\ManyToOne(targetEntity="App\Entity\Editor", cascade={"persist"}, inversedBy="messagesWritten")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;

    /**
     * @var Chat $chatroom Chat within the message is written
     * @ORM\ManyToOne(targetEntity="Chat", cascade={"persist"}, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chatroom;

    /**
     * @var Collection $abuses
     * @ORM\OneToMany(targetEntity="Abuse", mappedBy="message")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    private $abuses;

    public function __construct()
    {
        $this->abuses = new ArrayCollection();
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
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

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
     * @return Message
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSanctioned(): ?bool
    {
        return $this->sanctioned;
    }

    /**
     * @param bool $sanctioned
     * @return Message
     */
    public function setSanctioned(bool $sanctioned): self
    {
        $this->sanctioned = $sanctioned;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDownvoteCount(): ?int
    {
        return $this->downvoteCount;
    }

    /**
     * @param int $downvoteCount
     * @return Message
     */
    public function setDownvoteCount(int $downvoteCount): self
    {
        $this->downvoteCount = $downvoteCount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpvoteCount(): ?int
    {
        return $this->upvoteCount;
    }

    /**
     * @param int $upvoteCount
     * @return Message
     */
    public function setUpvoteCount(int $upvoteCount): self
    {
        $this->upvoteCount = $upvoteCount;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAttachmentFile(): ?string
    {
        return $this->attachmentFile;
    }

    /**
     * @param string $attachmentFile
     * @return Message
     */
    public function setAttachmentFile(string $attachmentFile): self
    {
        $this->attachmentFile = $attachmentFile;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAttachmentImage(): ?string
    {
        return $this->attachmentImage;
    }

    /**
     * @param null|string $attachmentImage
     * @return Message
     */
    public function setAttachmentImage(?string $attachmentImage): self
    {
        $this->attachmentImage = $attachmentImage;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAttachmentUrl(): ?string
    {
        return $this->attachmentUrl;
    }

    /**
     * @param null|string $attachmentUrl
     * @return Message
     */
    public function setAttachmentUrl(?string $attachmentUrl): self
    {
        $this->attachmentUrl = $attachmentUrl;

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
     * @return Message
     */
    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        if(!is_null($editor) && !$editor->getMessagesWritten()->contains($this)){
            $editor->addMessageWritten($this);
        }

        return $this;
    }

    /**
     * @return Chat|null
     */
    public function getChatroom(): ?Chat
    {
        return $this->chatroom;
    }

    /**
     * @param Chat|null $chatroom
     */
    public function setChatroom(?Chat $chatroom): self
    {
        $this->chatroom = $chatroom;

        if(($chatroom !== null) && !$chatroom->getMessages()->contains($this)){
            $chatroom->addMessage($this);
        }

        return $this;
    }

    /**
     * Get abuses
     *
     * @return Collection
     */
    public function getAbuses(): Collection
    {
        return $this->abuses;
    }

    /**
     * Add an abuse
     * @param Abuse $abuse
     * @return Message
     */
    public function addAbuse(Abuse $abuse): self
    {
        if(!$this->abuses->contains($abuse)){
            // Add the abuse
            $this->abuses->add($abuse);

            // Add a reference to this message in the Abuse instance
            if($abuse->getMessage() !== $this){
                $abuse->setMessage($this);
            }
        }

        return $this;
    }

    /**
     * Remove an abuse
     * @param Abuse $abuse
     * @return self
     */
    public function removeAbuse(Abuse $abuse): self
    {
        if($this->abuses->contains($abuse)){
            // Remove the abuse
            $this->abuses->removeElement($abuse);

            // Remove the reference to this Message in the Abuse instance
            if($abuse->getMessage() === $this){
                $abuse->setMessage(null);
            }
        }

        return $this;
    }
}
