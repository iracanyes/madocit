<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="mdit_moderator")
 * @ORM\Entity(repositoryClass="App\Repository\ModeratorRepository")
 */
class Moderator extends Editor
{
    /**
     * @var integer ID of the moderator
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * @var integer Number of sanctions emitted by the moderator
     * @ORM\Column(name="nb_sanction_emitted", type="integer")
     * @Assert\Type("integer")
     */
    private $nbSanctionEmitted;

    /**
     * @var integer Number of notes validated by the editor
     * @ORM\Column(name="nb_notes_validated", type="integer")
     * @Assert\Type("integer")
     */
    private $nbNotesValidated;

    /**
     * @var integer Average rating for all the activities of moderation
     * @ORM\Column(name="rate_moderation", type="integer")
     * @Assert\Type("integer")
     */
    private $rateModeration;

    /**
     * @var boolean The moderation is a global moderator
     * @ORM\Column(name="is_global_moderator", type="boolean")
     * @Assert\Type("integer")
     */
    private $isGlobalModerator;

    /**
     * @var Collection Notes validated
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="moderator")
     * @Assert\Collection()
     */
    private $notesValidated;

    /**
     * Sanctions emitted
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Sanction", mappedBy="moderator")
     * @Assert\Collection()
     */
    private $sanctionsEmitted;

    public function __construct()
    {
        parent::__construct();
        $this->notesValidated = $this->sanctionsEmitted = new ArrayCollection();
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
     * @return Collection
     */
    public function getSanctionsEmitted(): Collection
    {
        return $this->sanctionsEmitted;
    }



    /**
     * Add a sanction emitted
     *
     * @param Sanction $sanction
     * @return Note
     */
    public function addSanctionsEmitted(Sanction $sanction): self
    {
        if(!$this->sanctionsEmitted->contains($sanction)){
            $this->sanctionsEmitted->add($sanction);

            // Add a reference to this moderator in the sanction's object
            if($sanction->getModerator() !== $this){
                $sanction->setModerator($this);
            }


        }


        return $this;
    }

    /**
     * Remove a sanction emitted
     *
     * @param Sanction $sanction
     * @return Note
     */
    public function removeSanctionsEmitted(Sanction $sanction): self
    {
        if($this->sanctionsEmitted->contains($sanction)){
            $this->sanctionsEmitted->removeElement($sanction);

            if($sanction->getModerator() === $this){
                $sanction->setModerator(null);
            }

        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getNotesValidated(): Collection
    {
        return $this->notesValidated;
    }



    /**
     * Add a note validated by a moderator
     * @param Note $note
     * @return Note
     */
    public function addNotesValidated(Note $note): self
    {
        if(!$this->notesValidated->contains($note)){

            $this->notesValidated->add($note);

            if($note->getModerator() !== $this){
                $note->setModerator($this);
            }

        }

        return $this;
    }

    /**
     * Remove a note validator by a moderator
     *
     * @param Note $note
     * @return Note
     */
    public function removeNotesValidated(Note $note): self
    {
        if($this->notesValidated->contains($note)){
            $this->notesValidated->removeElement($note);

            if($note->getModerator() === $this){
                $note->setModerator(null);
            }
        }

        return $this;
    }
}
