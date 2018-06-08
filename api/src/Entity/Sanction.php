<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="mdit_sanction")
 * @ORM\Entity(repositoryClass="App\Repository\SanctionRepository")
 */
class Sanction
{
    /**
     * @var integer ID of the sanction
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string Type of sanction ()
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var \DateTime End date of the sanction
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $duration;

    /**
     * @var string Status of the sanction (active, finished)
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * Abuses sanctioned
     * @var Collection Abuses tackled by the sanction
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="sanction")
     * @Assert\Collection()
     */
    private $abuses;

    /**
     * Moderator
     * @var Moderator Moderator who made the sanction
     *
     * @ORM\ManyToOne(targetEntity="Moderator", cascade={"persist"}, inversedBy="sanctionsEmitted")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Moderator")
     */
    private $moderator;

    /**
     * Editor sanctioned
     * @var Editor Editor concerned by the sanction
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist","remove"}, inversedBy="sanctionsReceived")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Editor")
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
