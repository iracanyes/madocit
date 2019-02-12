<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     iri="http://schema.org/Person"
 * )
 * @ORM\Table(name="mdit_editor")
 * @ORM\Entity(repositoryClass="App\Repository\EditorRepository")
 * Héritage de cette classe : Chaque modérateur et/ou admin est un éditeur de contenu
 * @ ORM\InheritanceType("JOINED")
 * @ ORM\DiscriminatorColumn(name="editorType", type="string")
 * @ ORM\DiscriminatorMap({"editor" = "Editor", "moderator" = "Moderator", "admin" = "Admin"})
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
     * @Groups({"editor:output","editor:input"})
     */
    protected $id;

    /**
     * @ApiProperty(iri="http://schema.org/Text")
     * @var string Email for contacting the editor (optional)
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    protected $emailContact;

    /**
     * @ApiProperty(iri="http://schema.org/Text")
     *
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Nickname used in place of the real name
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\Length(
     *     min=5,
     *     max=55,
     *     minMessage="The minimumm set of character for the nickname is {{ limit }}. \n Your nickname length is {{ value }} characters!",
     *     maxMessage="The maximumm set of character for the nickname is {{ limit }}. \n Your nickname length is {{ value }} characters!"
     * )
     */
    protected $nickname;

    /**
     * @ApiProperty(iri="http://schema.org/Text")
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
    protected $familyName;

    /**
     * @ApiProperty(iri="http://schema.org/Text")
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
    protected $givenName;

    /**
     * @ApiProperty(iri="http://schema.org/Organization")
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
    protected $affiliation;

    /**
     * @ApiProperty(iri="http://schema.org/EducationalOrganization")
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
    protected $alumniOf;

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
    protected $rateGlobal;

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
    protected $rateContribution;

    /**
     * @var boolean The editor is sanctioned
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type("boolean")
     */
    protected $sanctioned;

    /**
     * @var Collection $groupsOwned Groups owned by this editor
     * @ORM\OneToMany(targetEntity="Group", mappedBy="owner")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $groupsOwned;

    /**
     * @var Collection $groupsMember Groups where this editor is member
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="members")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $groupsMember;


    /**
     * @var Collection $subjectsCreated Subjects created by the editor
     * @ORM\OneToMany(targetEntity="Subject", cascade={"persist","remove"}, mappedBy="author")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $subjectsCreated;

    /**
     * @var Collection $contributionsMade Contributions made by this editor
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="editor")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $contributionsMade;

    /**
     * @var Collection $chatroomsCreated Chatroom created by this editor
     * @ORM\OneToMany(targetEntity="Chat", cascade={"persist"}, mappedBy="creator")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $chatroomsCreated;

    /**
     * @var Collection $chatroomsInvolved Chatrooms in which the editor is involved
     * @ORM\OneToMany(targetEntity="App\Entity\EditorsChats", mappedBy="editor")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $chatroomsInvolved;


    /**
     * @var Collection $messagesWritten Messages written by the editor
     * @ORM\OneToMany(targetEntity="Message", mappedBy="editor")
     * @Assert\Collection()
     */
    protected $messagesWritten;

    /**
     * Notes
     * @var Collection $notesSuggested Notes suggested by this editor
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="editor")
     * @Assert\Collection()
     */
    protected $notesSuggested;


    /**
     * @var Collection $abusesIdentified Abuses identified
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="accuser")
     * @Assert\Collection()
     */
    protected $abusesIdentified;

    /**
     * @var Collection $abusesAccused Abuses accused
     *
     * @ORM\OneToMany(targetEntity="Abuse", cascade={"persist"}, mappedBy="defendant")
     * @Assert\Collection()
     */
    protected $abusesAccused;


    /**
     * Sanctions received
     * @var Collection $sanctionsReceived Sanctions received for abuses
     *
     * @ORM\OneToMany(targetEntity="Sanction", cascade={"persist","remove"}, mappedBy="editor")
     * @Assert\Collection()
     */
    protected $sanctionsReceived;

    /**
     * Editor constructor.
     */
    public function __construct()
    {
        // Appel du constructeur parent
        parent::__construct();

        // Initialisation des variables de types number
        $this->rateGlobal = $this->rateContribution = 0;

        // déclaration des collections de la classe
        $this->abusesIdentified = new ArrayCollection();
        $this->abusesAccused  = new ArrayCollection();
        $this->sanctionsReceived = new ArrayCollection();
        $this->groupsOwned = new ArrayCollection();
        $this->groupsMember = new ArrayCollection();
        $this->subjectsCreated = new ArrayCollection();
        $this->notesSuggested = new ArrayCollection();
        $this->chatroomsCreated = new ArrayCollection();
        $this->chatroomsInvolved = new ArrayCollection();
        $this->messagesWritten = new ArrayCollection();
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
     * @param null|string $editorType
     * @return Editor
     */
    public function setEditorType(?string $editorType): self
    {
        $this->editorType = $editorType;

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
     * @return Editor
     */
    public function addChatroomsCreated(Chat $chat): self
    {
        if(!$this->chatroomsCreated->contains($chat)){

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
     * @return self
     */
    public function removeChatroomsCreated(Chat $chat): self
    {
        if($this->chatroomsCreated->contains($chat)){
            // Remove the chat created
            $this->chatroomsCreated->removeElement($chat);

            if($chat->getCreator() === $this){
                // Remove the reference of this editor as the creator of the chatroom
                $chat->setCreator(null);

            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChatroomsInvolved(): Collection
    {
        return $this->chatroomsInvolved;
    }

    /**
     * @param EditorsChats $editorChat
     * @return Editor
     */
    public function addChatroomsInvolved(EditorsChats $editorChat): self
    {
        if(!$this->chatroomsInvolved->contains($editorChat)){
            // Add
            $this->chatroomsInvolved->add($editorChat);

            // Add a reference
            if($editorChat->getEditor() !== $this){

                $editorChat->setEditor($this);
            }

        }

        return $this;
    }

    /**
     * @param EditorsChats $editorChat
     * @return Editor
     */
    public function removeChatroomsInvolved(EditorsChats $editorChat): self
    {
        if($this->chatroomsInvolved->contains($editorChat)){
            // Remove
            $this->chatroomsInvolved->removeElement($editorChat);

            if($editorChat->getEditor() === $this){
                $editorChat->setEditor(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection
     */
    public function getGroupsOwned(): Collection
    {
        return $this->groupsOwned;
    }

    /**
     * @param Group $group
     * @return Editor
     */
    public function addGroupsOwned(Group $group): self
    {
        if(!$this->groupsOwned->contains($group)){
            // Add group
            $this->groupsOwned->add($group);

            // Add a reference in the group object
            if($group->getOwner() !== $this){
                $group->setOwner($this);
            }
        }

        return $this;
    }

    /**
     * Remove a group
     * @param Group $group
     * @return Editor
     */
    public function removeGroupsOwned(Group $group): self
    {

        if($this->groupsOwned->contains($group)){
            // Remove the group
            $this->groupsOwned->removeElement($group);

            // Remove the reference
            if($group->getOwner() === $this){
                $group->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGroupsMember(): Collection
    {
        return $this->groupsMember;
    }

    /**
     * @param Group $group
     * @return Editor
     */
    public function addGroupsMember(Group $group): self
    {
        if(!$this->groupsMember->contains($group)){
            // Add group
            $this->groupsMember->add($group);


        }

        return $this;
    }

    /**
     * Remove a group where this editor is member
     * @param Group $group
     * @return Editor
     */
    public function removeGroupsMember(Group $group): self
    {
        if($this->groupsMember->contains($group)){
            // Remove the group
            $this->groupsMember->removeElement($group);


        }

        return $this;
    }


    /**
     * Get subjects created
     *
     * @return Collection
     */
    public function getSubjectsCreated(): Collection
    {
        return $this->subjectsCreated;
    }

    /**
     * Add a subject created
     *
     * @param Subject $subject
     * @return Editor
     */
    public function addSubjectsCreated(Subject $subject): self
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
     * @return Editor
     */
    public function removeSubjectsCreated(Subject $subject): self
    {
        if($this->subjectsCreated->contains($subject)){
            // Remove a subject created
            $this->subjectsCreated->add($subject);

            if($subject->getAuthor() === $this){
                // Remove a reference to this editor as the  creator of the subject
                $subject->setAuthor(null);
            }
        }

        return $this;
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
     * @return Editor
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
     * @return Editor
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
     * @return Editor
     */
    public function removeContributionMade(Contribution $contribution): self
    {
        if($this->contributionsMade->contains($contribution)){
            //Remove the contribution
            $this->contributionsMade->removeElement($contribution);

            if($contribution->getEditor() === $this){
                $contribution->setEditor(null);
            }
        }

        return $this;
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
     * @return Editor
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
     * @return Editor
     */
    public function removeSanctionReceived(Sanction $sanction): self
    {
        if($this->sanctionsReceived->contains($sanction)){
            // Remove a sanction received
            $this->sanctionsReceived->removeElement($sanction);

            if($sanction->getEditor() === $this){
                // Remove a reference to this editor as being charged by the sanction
                $sanction->setEditor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMessagesWritten(): Collection
    {
        return $this->messagesWritten;
    }

    /**
     * @param Message $message
     * @return Editor
     */
    public function addMessageWritten(Message $message): self
    {
        if(!$this->messagesWritten->contains($message)){
            // Add the message
            $this->messagesWritten->add($message);

            // Add a reference to this Editor in the Message instance
            if($message->getEditor() !== $this ){
                $message->setEditor($this);
            }
        }

        return $this;
    }


    /**
     * @param Message $message
     * @return void
     */
    public function removeMessageWritten(Message $message): void
    {
        if($this->messagesWritten->contains($message)){
            // Remove the message
            $this->messagesWritten->removeElement($message);

            // Remove the reference to the Editor in the Message instance
            if($message->getEditor() === $this){
                $message->setEditor(null);
            }
        }
    }
}
