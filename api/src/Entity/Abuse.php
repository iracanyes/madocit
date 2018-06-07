<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Editor;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_abuse")
 * @ORM\Entity(repositoryClass="App\Repository\AbuseRepository")
 */
class Abuse
{
    /**
     * @var integer ID of the abuse
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Description of the abuse
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Datetime Date of the creation of the abuse
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var Editor Editor who identify
     *
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="abusesIdentified")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accuser;

    /**
     * @var Editor Charged person
     *
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="abusesAccused")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defendant;

    /**
     * @var Chat Chatroom of the abuse
     *
     * @ORM\ManyToOne(targetEntity="Chat", cascade={"persist"}, inversedBy="abuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chat;

    /**
     *
     * @var Sanction Sanction for this abuse
     *
     * @ORM\ManyToOne(targetEntity="Sanction", cascade={"persist","remove"}, inversedBy="abuses")
     */
    private $sanction;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return \App\Entity\Editor
     */
    public function getAccuser(): \App\Entity\Editor
    {
        return $this->accuser;
    }

    /**
     * @param Editor|null $accuser
     */
    public function setAccuser(?Editor $accuser): void
    {
        $this->accuser = $accuser;
    }

    /**
     * @return Editor|null
     */
    public function getDefendant(): Editor
    {
        return $this->defendant;
    }

    /**
     * @param Editor $defendant
     */
    public function setDefendant(?Editor $defendant): void
    {
        $this->defendant = $defendant;
    }

    /**
     * @return Chat|null
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param Chat|null $chat
     */
    public function setChat(?Chat $chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return Sanction|null
     */
    public function getSanction(): Sanction
    {
        return $this->sanction;
    }

    /**
     * @param Sanction|null $sanction
     */
    public function setSanction(?Sanction $sanction): void
    {
        $this->sanction = $sanction;
    }


}
