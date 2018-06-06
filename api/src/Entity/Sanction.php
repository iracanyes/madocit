<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mdit_sanction")
 * @ORM\Entity(repositoryClass="App\Repository\SanctionRepository")
 */
class Sanction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * Abuses sanctioned
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="sanction")
     */
    private $abuses;

    /**
     * Moderator
     * @var Moderator
     *
     * @ORM\ManyToOne(targetEntity="Moderator", cascade={"persist"}, inversedBy="sanctionsEmitted")
     * @ORM\JoinColumn(nullable=false)
     */
    private $moderator;

    /**
     * Editor sanctioned
     * @var Editor
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist","remove"}, inversedBy="sanctionsReceived")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;



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
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    /**
     * @param \DateTimeInterface|null $duration
     * @return Sanction
     */
    public function setDuration(?\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Add an abuse
     *
     * @param Abuse|null $abuse
     * @return self
     */
    public function addAbuse(?Abuse $abuse): self
    {
        if(!$this->abuses->contains($abuse)){
            $this->abuses->add($abuse);

            $abuse->setSanction($this);
        }


        return $this;
    }

    /**
     * Remove an abuse
     *
     * @param Abuse|null $abuse
     * @return void
     */
    public function removeAbuse(?Abuse $abuse): void
    {
        if($this->abuses->contains($abuse)){
            $this->abuses->removeElement($abuse);

            if($abuse->getSanction() === $this){
                $abuse->setSanction(null);
            }
        }

    }

    /**
     * @return Moderator
     */
    public function getModerator(): Moderator
    {
        return $this->moderator;
    }

    /**
     * @param Moderator|null $moderator
     */
    public function setModerator(?Moderator $moderator): void
    {
        $this->moderator = $moderator;
    }

    /**
     * @return Editor
     */
    public function getEditor(): Editor
    {
        return $this->editor;
    }

    /**
     * @param Editor|null $editor
     */
    public function setEditor(?Editor $editor): void
    {
        $this->editor = $editor;
    }


}
