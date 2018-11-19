<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_editors_chats")
 * @ORM\Entity(repositoryClass="App\Repository\EditorsChatsRepository")
 */
class EditorsChats
{
    /**
     * @var int $id ID of the editor's chat
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int $nbUnreadMessages Number of unread messages of this chat
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $nbUnreadMessages;

    /**
     * @var Editor $editor Editor associated to this chat
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="chatroomsInvolved")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $editor;

    /**
     * @var Chat $chatroom Chat associated to this editor
     * @ORM\ManyToOne(targetEntity="Chat", cascade={"persist"}, inversedBy="chatEditors")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Chat")
     */
    private $chatroom;

    /**
     * EditorsChats constructor.
     */
    public function __construct()
    {
        $this->nbUnreadMessages = 0;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getNbUnreadMessages(): ?int
    {
        return $this->nbUnreadMessages;
    }

    /**
     * @param int $nbUnreadMessages
     * @return EditorsChats
     */
    public function setNbUnreadMessages(int $nbUnreadMessages): self
    {
        $this->nbUnreadMessages = $nbUnreadMessages;

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
     * @return EditorsChats
     */
    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        if(!is_null($editor) && !$editor->getChatroomsInvolved()->contains($this)){
            $editor->addChatroomsInvolved($this);
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
     * @param Chat $chatroom
     * @return EditorsChats
     */
    public function setChatroom(?Chat $chatroom): self
    {
        $this->chatroom = $chatroom;

        if(!is_null($chatroom) && !$chatroom->getChatEditors()->contains($this)){
            $chatroom->addChatEditors($this);
        }

        return $this;
    }




}
