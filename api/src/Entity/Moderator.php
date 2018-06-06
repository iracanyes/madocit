<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mdit_moderator")
 * @ORM\Entity(repositoryClass="App\Repository\ModeratorRepository")
 */
class Moderator extends Editor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nb_sanction_emitted", type="integer")
     */
    private $nbSanctionEmitted;

    /**
     * @ORM\Column(name="nb_notes_validated", type="integer")
     */
    private $nbNotesValidated;

    /**
     * @ORM\Column(name="rate_moderation", type="integer")
     */
    private $rateModeration;

    /**
     * @ORM\Column(name="is_global_moderator", type="boolean")
     */
    private $isGlobalModerator;

    /**
     * @var ArrayCollection Notes validated
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="moderator")
     */
    private $notesValidated;

    /**
     * Sanctions emitted
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Sanction", mappedBy="moderator")
     */
    private $sanctionsEmitted;

    public function __construct()
    {
        $this->sanctionsEmitted = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNbSanctionEmitted(): ?int
    {
        return $this->nbSanctionEmitted;
    }

    public function setNbSanctionEmitted(int $nbSanctionEmitted): self
    {
        $this->nbSanctionEmitted = $nbSanctionEmitted;

        return $this;
    }

    public function getNbNotesValidated(): ?int
    {
        return $this->nbNotesValidated;
    }

    public function setNbNotesValidated(int $nbNotesValidated): self
    {
        $this->nbNotesValidated = $nbNotesValidated;

        return $this;
    }

    public function getRateModeration(): ?int
    {
        return $this->rateModeration;
    }

    public function setRateModeration(int $rateModeration): self
    {
        $this->rateModeration = $rateModeration;

        return $this;
    }

    public function getIsGlobalModerator(): ?bool
    {
        return $this->isGlobalModerator;
    }

    public function setIsGlobalModerator(bool $isGlobalModerator): self
    {
        $this->isGlobalModerator = $isGlobalModerator;

        return $this;
    }

    /**
     * Add a sanction emitted
     *
     * @param Sanction $sanction
     * @return self
     */
    public function addSanctionEmitted(Sanction $sanction): self
    {
        if(!$this->sanctionsEmitted->contains($sanction)){
            $this->sanctionsEmitted->add($sanction);

            $sanction->setModerator($this);
        }


        return $this;
    }

    /**
     * Remove a sanction emitted
     *
     * @param Sanction $sanction
     * @return void
     */
    public function removeSanctionEmitted(Sanction $sanction): void
    {
        if($this->sanctionsEmitted->contains($sanction)){
            $this->sanctionsEmitted->removeElement($sanction);

            if($sanction->getModerator() === $this){
                $sanction->setModerator(null);
            }

        }
    }

    /**
     * Add a note validated by a moderator
     * @param Note $note
     * @return self
     */
    public function addNoteValidated(Note $note): self
    {
        if(!$this->notesValidated->contains($note)){
            $this->notesValidated->add($note);

            $note->setModerator($this);
        }

        return $this;
    }

    /**
     * Remove a note validator by a moderator
     *
     * @param Note $note
     * @return void
     */
    public function removeNoteValidated(Note $note): void
    {
        if($this->notesValidated->contains($note)){
            $this->notesValidated->removeElement($note);

            if($note->getModerator() === $this){
                $note->setModerator(null);
            }
        }
    }
}
