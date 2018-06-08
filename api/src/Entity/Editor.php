<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_editor")
 * @ORM\Entity(repositoryClass="App\Repository\EditorRepository")
 * Héritage de cette classe : Chaque modérateur et/ou admin est un éditeur de contenu
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="editorType", type="string", length=255)
 * @ORM\DiscriminatorMap({"editor" = "Editor", "moderator" = "Moderator", "admin" = "Admin"})
 * Contraintes d'unicité sur les surnoms des éditeurs (nickname)
 * @UniqueEntity("nickname")
 */
class Editor extends User
{
    /**
     * @var integer ID of the editor
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string Email for contacting the editor (optional)
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $emailContact;

    /**
     * @var string Nickname used in place of the real name
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=5,
     *     max=55,
     *     minMessage="The minimumm set of character for the nickname is {{ limit }}. \n Your nickname length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the nickname is {{ limit }}. \n Your nickname length is {{ value }} characters!"
     * )
     */
    private $nickname;

    /**
     * @var string Family name of the editor
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=5,
     *     max=55,
     *     minMessage="The minimumm set of character for the family name is {{ limit }}. \n Your nickname length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the family name is {{ limit }}. \n Your nickname length is {{ value }} characters!"
     * )
     */
    private $familyName;

    /**
     * @var string First name of the editor
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=5,
     *     max=55,
     *     minMessage="The minimumm set of character for the given name is {{ limit }}. \n Your given name's length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the given name is {{ limit }}. \n Your given name's length is {{ value }} characters!"
     * )
     */
    private $givenName;

    /**
     * @var string School or company where the editor is affiliated to
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=10,
     *     max=180,
     *     minMessage="The minimumm set of character for the affiliation is {{ limit }}. \n Your affiliation's length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the affiliation is {{ limit }}. \n Your affiliation's length is {{ value }} characters!"
     * )
     */
    private $affiliation;

    /**
     * @var string Last school of the editor
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=10,
     *     max=180,
     *     minMessage="The minimumm set of character for the 'alumni of' is {{ limit }}. \n Your 'alumni of' length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the 'alumni of' is {{ limit }}. \n Your 'alumni of' length is {{ value }} characters!"
     * )
     */
    private $alumniOf;

    /**
     * @var integer Global rate for all activities done on the platform
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     * @Assert\Range(
     *     min=0,
     *     max=100,
     *     minMessage="The minimumm global rate is {{ limit }}. \n Your global rate's value is {{ value }} !",
     *     maxMessage="The maximumm global rate is {{ limit }}. \n Your global rate's value is {{ value }} !"
     * )
     */
    private $rateGlobal;

    /**
     * @var integer Aggregate rating of all votes by users for all the contributions done by the editor
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("int")
     * @Assert\Range(
     *     min=0,
     *     max=100,
     *     minMessage="The minimumm contribution rate is {{ limit }}. \n Your contribution rate's value is {{ value }} !",
     *     maxMessage="The maximumm contribution rate is {{ limit }}. \n Your contribution rate's value is {{ value }} !"
     * )
     */
    private $rateContribution;

    /**
     * @var boolean The editor is sanctioned
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type("boolean")
     */
    private $sanctioned;

    /**
     * @var Collection $subjectsCreated Subjects created by the editor
     * @ORM\OneToMany(targetEntity="Subject", mappedBy="author")
     * @Assert\Collection()
     */
    private $subjectsCreated;

    /**
     * @var Collection $contributionsMade Contributions made by this editor
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="editor")
     * @Assert\Collection()
     */
    private $contributionsMade;

    /**
     * @var Collection $chatroomsCreated Chatroom created by this editor
     * @ORM\OneToMany(targetEntity="Chat", mappedBy="creator")
     * @Assert\Collection()
     */
    private $chatroomsCreated;

    /**
     * @var Collection $chatroomsInvolved Chatroom in which this editor is or has been involved
     * @ORM\ManyToMany(targetEntity="Chat", cascade={"persist"}, inversedBy="editorsInvolved")
     * @ORM\JoinTable(name="mdit_chat_editors")
     * @Assert\Collection()
     */
    private $chatroomsInvolved;


    /**
     * Notes
     * @var Collection $notesSuggested Notes suggested by this editor
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="editor")
     * @Assert\Collection()
     */
    private $notesSuggested;


    /**
     * @var Collection $abusesIdentified Abuses identified
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="accuser")
     * @Assert\Collection()
     */
    private $abusesIdentified;

    /**
     * @var Collection $abusesAccused Abuses accused
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="defendant")
     * @Assert\Collection()
     */
    private $abusesAccused;


    /**
     * Sanctions received
     * @var Collection $sanctionsReceived Sanctions received for abuses
     *
     * @ORM\OneToMany(targetEntity="Sanction", cascade={"persist","remove"}, mappedBy="editor")
     * @Assert\Collection()
     */
    private $sanctionsReceived;

    /**
     * Editor constructor.
     */
    public function __construct()
    {
        // Appel du constructeur parent
        parent::__construct();

        // déclaration des collections de la classe
        $this->abusesIdentified =
            $this->abusesAccused  =
            $this->sanctionsReceived =
            $this->notesSuggested =
            $this->chatroomsInvolved =
            $this->contributionsMade = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    /**
     * @param null|string $emailContact
     * @return Editor
     */
    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param null|string $nickname
     * @return Editor
     */
    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    /**
     * @param null|string $familyName
     * @return Editor
     */
    public function setFamilyName(?string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    /**
     * @param null|string $givenName
     * @return Editor
     */
    public function setGivenName(?string $givenName): self
    {
        $this->givenName = $givenName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    /**
     * @param null|string $affiliation
     * @return Editor
     */
    public function setAffiliation(?string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAlumniOf(): ?string
    {
        return $this->alumniOf;
    }

    /**
     * @param null|string $alumniOf
     * @return Editor
     */
    public function setAlumniOf(?string $alumniOf): self
    {
        $this->alumniOf = $alumniOf;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRateGlobal(): ?int
    {
        return $this->rateGlobal;
    }

    /**
     * @param int $rateGlobal
     * @return Editor
     */
    public function setRateGlobal(int $rateGlobal): self
    {
        $this->rateGlobal = $rateGlobal;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRateContribution(): ?string
    {
        return $this->rateContribution;
    }

    public function setRateContribution(string $rateContribution): self
    {
        $this->rateContribution = $rateContribution;

        return $this;
    }

    public function getSanctioned(): ?bool
    {
        return $this->sanctioned;
    }

    public function setSanctioned(?bool $sanctioned): self
    {
        $this->sanctioned = $sanctioned;

        return $this;
    }

    /**
     * Get chatrooms created
     *
     * @return Collection|null
     */
    public function getChatroomsCreated(): ?Collection
    {
        return $this->chatroomsCreated;
    }

    /**
     * Add a chatroom created
     *
     * @param Chat $chat
     * @return self
     */
    public function addChatroomCreated(Chat $chat): self
    {
        if(!$this->subjectsCreated->contains($chat)){

            // Add a chatroom
            $this->chatroomsCreated->add($chat);

            if($chat->getCreator() !== $this){

                // Add a reference to this editor in the chat instance
                $chat->setCreator($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom created
     *
     * @param Chat $chat
     * @return void
     */
    public function removeChatroomCreated(Chat $chat): void
    {
        if($this->chatroomsCreated->contains($chat)){
            // Remove the chat created
            $this->chatroomsCreated->removeElement($chat);

            if($chat->getCreator() === $this){
                // Remove the reference of this editor as the creator of the chatroom
                $chat->setCreator(null);

            }
        }
    }

    /**
     * Get chatrooms involved
     *
     * @return Collection|null
     */
    public function getChatroomsInvolved(): ?Collection
    {
        return $this->chatroomsInvolved;
    }

    /**
     * Add a chatroom involved
     *
     * @param Chat $chat
     * @return self
     */
    public function addChatroomInvolved(Chat $chatroom): self
    {
        if(!$this->chatroomsInvolved->contains($chatroom)){
            // Add a chatroom
            $this->chatroomsInvolved->add($chatroom);

            if($chatroom->getEditorsInvolved()->contains($this)){
                // Add a reference to this editor in the chatroom
                $chatroom->getEditorsInvolved()->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom involved
     *
     * @param Chat $chatroom
     * @return void
     */
    public function removeChatroomInvolved(Chat $chatroom): void
    {
        if($this->chatroomsInvolved->contains($chatroom)){
            // Remove a chat involved
            $this->chatroomsInvolved->removeElement($chatroom);

            if($chatroom->getEditorsInvolved()->contains($this)){
                // Remove a reference to this editor in the chatroom
                $chatroom->getEditorsInvolved()->removeElement($chatroom);
            }
        }
    }

    /**
     * Get subjects created
     *
     * @return Collection|null
     */
    public function getSubjectsCreated(): ?Collection
    {
        return $this->subjectsCreated;
    }

    /**
     * Add a subject created
     *
     * @param Subject $subject
     * @return self
     */
    public function addSubjectCreated(Subject $subject): self
    {
        if(!$this->subjectsCreated->contains($subject)){

            // Add a subject created
            $this->subjectsCreated->add($subject);

            if($subject->getAuthor() !== $this){
                // Add a reference to this editor as the  creator of the subject
                $subject->setAuthor($this);
            }
        }

        return $this;
    }

    /**
     * Remove a subject created
     *
     * @param Subject $subject
     * @return void
     */
    public function removeSubjectCreated(Subject $subject): void
    {
        if($this->subjectsCreated->contains($subject)){
            // Remove a subject created
            $this->subjectsCreated->add($subject);

            if($subject->getAuthor() === $this){
                // Remove a reference to this editor as the  creator of the subject
                $subject->setAuthor(null);
            }
        }
    }

    /**
     * Get notes suggested
     *
     * @return Collection|null
     */
    public function getNotesSuggested(): ?Collection
    {
        return $this->notesSuggested;
    }

    /**
     * Add a note suggested by this editor
     *
     * @param Note $note
     * @return self
     */
    public function addNoteSuggested(Note $note): self
    {
        if(!$this->notesSuggested->contains($note)){
            // Add a note suggested
            $this->notesSuggested->add($note);

            if($note->getEditor() !== $this){
                // Add a reference to this editor as the one who suggested the note
                $note->setEditor($this);
            }
        }

        return $this;
    }

    /**
     * Remove a note suggested
     *
     * @param Note $note
     * @return void
     */
    public function removeNoteSuggested(Note $note): void
    {
        if($this->notesSuggested->contains($note)){

            $this->notesSuggested->removeElement($note);

            if($note->getEditor() === $this){
                $note->setEditor(null);
            }
        }
    }

    /**
     * Get contributions made
     *
     * @return Collection
     */
    public function getContributionsMade(): Collection
    {
        return $this->contributionsMade;
    }

    /**
     * Add a contribution made
     *
     * @param Contribution $contribution
     * @return self
     */
    public function addContributionMade(Contribution $contribution): self
    {
        if(!$this->contributionsMade->contains($contribution)){
            // Add a contribution made
            $this->contributionsMade->add($contribution);

            if($contribution->getEditor() !== $this){
                // Add a reference to this editor as who made the contribution
                $contribution->setEditor($this);
            }
        }

        return $this;
    }

    /**
     * Remove a contribution made
     *
     * @param Contribution $contribution
     * @return void
     */
    public function removeContributionMade(Contribution $contribution): void
    {
        if($this->contributionsMade->contains($contribution)){
            //Remove the contribution
            $this->contributionsMade->removeElement($contribution);

            if($contribution->getEditor() === $this){
                $contribution->setEditor(null);
            }
        }
    }

    /**
     * Get abuses identified
     *
     * @return Collection
     */
    public function getAbusesIdentified(): ?Collection
    {
        return $this->abusesIdentified;
    }

    /**
     * Add an identified abuse
     *
     * @param Abuse $abuse
     * @return Editor
     */
    public function addAbuseIdentified(Abuse $abuse): self
    {
        if(!$this->abusesIdentified->contains($abuse)){
            // Add an abuse
            $this->abusesIdentified->add($abuse);

            if($abuse->getAccuser() !== $this){
                // Add a reference of the Editor instance in the Abuse instance
                $abuse->setAccuser($this);
            }
        }

        return $this;
    }

    /**
     * Remove a identified abuse
     *
     * @param Abuse $abuse
     * @return void
     */
    public function removeAbuseIdentified(Abuse $abuse):void
    {
        if($this->abusesIdentified->contains($abuse)){
            $this->abusesIdentified->removeElement($abuse);

            if($abuse->getAccuser() === $this){

                $abuse->setAccuser(null);
            }
        }

    }

    /**
     * Get abuses accused
     *
     * @return Collection
     */
    public function getAbusesAccused(): ?Collection
    {
        return $this->abusesAccused;
    }

    /**
     * Add a charging abuse
     *
     * @param Abuse $abuse
     * @return Editor
     */
    public function addAbuseAccused(Abuse $abuse): self
    {
        if(!$this->abusesAccused->contains($abuse)){

            $this->abusesAccused->add($abuse);

            $abuse->setDefendant($this);
        }


        return $this;
    }

    /**
     * Remove a charging abuse
     *
     * @param Abuse $abuse
     * @return void
     */
    public function removeAbuseAccused(Abuse $abuse): void
    {
        if($this->abusesAccused->contains($abuse)){
            $this->abusesAccused->removeElement($abuse);

            if($abuse->getEditor() === $this){

                $abuse->setEditor(null);
            }
        }


    }

    /**
     * Get sanctions received
     *
     * @return Collection
     */
    public function getSanctionsReceived(): ?Collection
    {
        return $this->sanctionsReceived;
    }

    /**
     * Add sanction received to Editor
     *
     * @param Sanction $sanction
     * @return self
     */
    public function addSanctionReceived(Sanction $sanction): self
    {
        if(!$this->sanctionsReceived->contains($sanction)){
            // Add a sanction received
            $this->sanctionsReceived->add($sanction);

            if(!$sanction->getEditor() === $this){
                // Add a reference to this editor as being charged by the sanction
                $sanction->setEditor($this);
            }

        }

        return $this;

    }

    /**
     * Remove sanction received to Editor
     *
     * @param Sanction $sanction
     * @return void
     */
    public function removeSanctionReceived(Sanction $sanction): void
    {
        if($this->sanctionsReceived->contains($sanction)){
            // Remove a sanction received
            $this->sanctionsReceived->removeElement($sanction);

            if($sanction->getEditor() === $this){
                // Remove a reference to this editor as being charged by the sanction
                $sanction->setEditor(null);
            }
        }
    }



}
