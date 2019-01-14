<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"article:output"}},
 *     denormalizationContext={"groups"={"article:input"}}
 * )
 * @ORM\Table(name="mdit_subject")
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * Validation de la contrainte d'unicité des titres des sujets
 * @ UniqueEntity("title")
 * Héritage
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="subject_type", type="string", length=255)
 * @ORM\DiscriminatorMap({"subject" = "Subject", "article" = "Article", "grain" = "Grain"})
 */
class Subject
{
    /**
     * @var integer ID of the subject
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Title of the subject
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @var string Description of the subject (optional)
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @var string Prerequisites needed to fulfill steps in article. (optional)
     * @ORM\Column(type="text", nullable=true)
     */
    protected $dependencies;

    /**
     * @var string Proficiency needed for this content; expected values: 'Beginner', 'Expert'. (optional)
     * @ORM\Column(type="text", nullable=true)
     */
    protected $proficiencyLevel;

    /**
     * @var boolean Subject has been validated
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    protected $isValid;


    /**
     * @var Collection $categories Categories in which this subject belongs
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="subjects")
     * @Assert\Collection()
     */
    protected $categories;

    /**
     * @var Collection $themes Theme that are evoked in the subject
     * @ORM\ManyToMany(targetEntity="Theme", cascade={"persist"}, inversedBy="subjects")
     * @ORM\JoinTable(name="mdit_themes_subjects")
     * @Assert\Collection()
     *
     */
    protected $themes;


    /**
     * @var Editor $editor Editor who create this subject
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="subjectsCreated")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    protected $author;

    /**
     * @var Collection $privileges Privileges on this subject
     * @ORM\OneToMany(targetEntity="Privilege", mappedBy="subject")
     */
    protected $privileges;



    /**
     * @var Collection Notes on the subject
     *
     * @ORM\OneToMany(targetEntity="Note", cascade={"persist"}, mappedBy="subject")
     * @Assert\Collection()
     */
    protected $notes;

    /**
     * @var Collection $examples Examples explaining this subject
     * @ORM\ManyToMany(targetEntity="Example", cascade={"persist"}, inversedBy="subjects")
     * @ORM\JoinTable(name="mdit_subjects_examples")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    protected $examples;


    /**
     * @var Collection Contributions suggested on this subject
     *
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="subject")
     * @Assert\Collection()
     */
    protected $contributionsSuggested;


    /**
     * @var Collection Chatroom of this subject
     *
     * @ORM\OneToMany(targetEntity="Chat", mappedBy="subject")
     * @Assert\Collection()
     */
    protected $chatrooms;

    /**
     * @var Collection $versions Subject's versions
     *
     * @ORM\ManyToMany(targetEntity="Version", cascade={"persist"}, inversedBy="subjects")
     * @ORM\JoinTable(name="mdit_subjects_versions")
     * @Assert\Type("App\Entity\Version")
     */
    protected $versions;

    /**
     * @var Collection Images illustrating the subject
     * @ORM\OneToMany(targetEntity="Image", mappedBy="subject")
     * @Assert\Collection()
     */
    protected $images;

    /**
     * @var Video|null $video
     * @ORM\OneToOne(targetEntity="Video", cascade={"persist","remove"}, inversedBy="associatedSubject")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", nullable=true)
     * @Assert\Type("App\Entity\Video")
     */
    protected $video;

    /**
     * Subject constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->themes = new ArrayCollection();
        $this->versions = new ArrayCollection();
        $this->privileges = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->examples = new ArrayCollection();
        $this->contributionsSuggested = new ArrayCollection();
        $this->chatrooms = new ArrayCollection();
        $this->images  = new ArrayCollection();


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Subject
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Subject
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDependencies(): ?string
    {
        return $this->dependencies;
    }

    /**
     * @param null|string $dependencies
     * @return Subject
     */
    public function setDependencies(?string $dependencies): self
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getProficiencyLevel(): ?string
    {
        return $this->proficiencyLevel;
    }

    /**
     * @param null|string $proficiencyLevel
     * @return Subject
     */
    public function setProficiencyLevel(?string $proficiencyLevel): self
    {
        $this->proficiencyLevel = $proficiencyLevel;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    /**
     * @param bool|null $isValid
     * @return Subject
     */
    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }


    /**
     * @return Video|nul
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     */
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }


    /**
     * @return Editor|null
     */
    public function getAuthor(): ?Editor
    {
        return $this->author;
    }

    /**
     * @param Editor|null $editor
     * @return Subject
     */
    public function setAuthor(?Editor $editor): self
    {
        $this->author = $editor;

        if($editor !== null){
            $editor->addSubjectsCreated($this);
        }

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection $collection
     * @return Subject
     */
    public function setCategories(Collection $collection): self
    {
        $this->categories = $collection;
    }

    /**
     * @param Category $category
     * @return Subject
     */
    public function addCategory(Category $category): self
    {
        if(!$this->categories->contains($category)){
            $this->categories->add($category);

            if(!$category->getSubjects()->contains($this)){
                $category->addSubjects($this);
            }
        }

        return $this;
    }

    /**
     * Remove a subject
     *
     * @param Category $category
     * @return Subject
     */
    public function removeCategory(Category $category): self
    {
        if($this->categories->contains($category)){
            // Remove a category
            $this->categories->removeElement($category);

            // Remove a reference
            if($category->getSubjects()->contains($this)){
                $category->getSubjects()->removeElement($this);
            }
        }

        return $this;
    }



    /**
     * @return Collection|null
     */
    public function getThemes(): ?Collection
    {
        return $this->themes;
    }

    /**
     * @param Theme $theme
     * @return Subject
     */
    public function addTheme(Theme $theme): self
    {
        if(!$this->themes->contains($theme)){
            $this->themes->add($theme);

            if(!$theme->getSubjects()->contains($this)){
                $theme->addSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove a theme
     *
     * @param Theme $theme
     * @return Subject
     */
    public function removeTheme(Theme $theme): self
    {
        if($this->themes->contains($theme)){
            $this->themes->removeElement($theme);

            if($theme->getSubjects()->contains($this)){

                $theme->getSubjects()->removeElement($this);
            }
        }

        return $this;
    }


    /**
     * @return Collection|null
     */
    public function getPrivileges(): ?Collection
    {
        return $this->privileges;
    }

    /**
     * @param Privilege $privilege
     * @return Subject
     */
    public function addPrivilege(Privilege $privilege): self
    {
        if(!$this->privileges->contains($privilege)){
            // Add the privilege
            $this->privileges->add($privilege);

            // Add a reference to this subject in the Privilege Object
            if($privilege->getSubject() !== $this){
                $privilege->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * @param Privilege $privilege
     * @return Subject
     */
    public function removePrivilege(Privilege $privilege): self
    {
        if($this->privileges->contains($privilege)){
            $this->privileges->removeElement($privilege);

            if($privilege->getSubject() === $this){
                $privilege->setSubject(null);
            }
        }

        return $this;
    }




    /**
     * Get notes
     * @return Collection|null
     */
    public function getNotes(): ?Collection
    {
        return $this->notes;
    }

    /**
     * Add a Note
     *
     * @param Note $note
     * @return self
     */
    public function addNote(Note $note): self
    {
        if(!$this->notes->contains($note)){
            $this->notes->add($note);

            if($note->getSubject() === $this){
                $note->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove note on a subject
     *
     * @param Subject $subject
     * @return self
     */
    public function removeNote(Note $note): self
    {
        if($this->notes->contains($note)){
            $this->notes->removeElement($note);

            if($note->getSubject() === $this){
                $note->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getExamples(): ?Collection
    {
        return $this->examples;
    }

    /**
     * @param Example $example
     * @return Subject
     */
    public function addExample(Example $example): self
    {
        if(!$this->examples->contains($example)){
            // Add
            $this->examples->add($example);

            // Add a reference
            if(!$example->getSubjects()->contains($this)){
                $example->getSubjects()->add($this);
            }
        }

        return $this;
    }

    /**
     * Remove an example
     * @param Example $example
     * @return Subject
     */
    public function removeExample(Example $example): self
    {
        if($this->examples->contains($example)){
            $this->examples->removeElement($example);

            if($example->getSubjects()->contains($this)){
                $example->getSubjects()->removeElement($this);
            }
        }
    }


    /**
     * Get contributions suggested
     *
     * @return Collection|null
     */
    public function getContributionsSuggested(): ?Collection
    {
        return $this->contributionsSuggested;
    }

    /**
     * Add a contribution suggested
     *
     * @param Contribution $contribution
     * @return self
     */
    public function addContributionsSuggested(Contribution $contribution): self
    {
        if(!$this->contributionsSuggested->contains($contribution)){
            // Add a contribution
            $this->contributionsSuggested->add($contribution);

            if($contribution->getSubject() !== $this){
                // Add a reference to this subject in contribution instance
                $contribution->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove a contribution made
     *
     * @param Contribution $contribution
     * @return self
     */
    public function removeContributionsSuggested(Contribution $contribution): self
    {
        if($this->contributionsSuggested->contains($contribution)){
            // Remove a contribution
            $this->contributionsSuggested->removeElement($contribution);

            if($contribution->getSubject() === $this){
                // Remove the reference to this subject
                $contribution->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * Get chatrooms tackling this subject
     * @return Collection|null
     */
    public function getChatrooms(): ?Collection
    {
        return $this->chatrooms;
    }

    /**
     * Add a chatroom tackling this subject
     * @param Chat|null $chatroom
     * @return self
     */
    public function addChatroom(Chat $chatroom): self
    {
        if(!$this->chatrooms->contains($chatroom)){
            // Add a chatroom
            $this->chatrooms->add($chatroom);

            if($chatroom->getSubject() !== $this){
                // Add a reference to this subject as tackled in the chatroom
                $chatroom->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove a chatroom tackling this subject
     * @param Chat $chatroom
     * @return void
     */
    public function removeChatroom(Chat $chatroom):void
    {
        if($this->chatrooms->contains($chatroom)){
            // Remove the chatroom
            $this->chatrooms->removeElement($chatroom);

            if($chatroom->getSubject() === $this){
                // Remove the reference to this subject in the chatroom instance
                $chatroom->setSubject(null);
            }
        }
    }

    /**
     * @return Collection|null
     */
    public function getVersions(): ?Collection
    {
        return $this->versions;
    }

    /**
     * @param Version $version
     * @return Subject
     */
    public function addVersion(Version $version): self
    {
        if(!$this->versions->contains($version)){
            $this->versions->add($version);

            if(!$version->getSubjects()->contains($this)){
                $version->addSubject($this);
            }
        }

        return $this;
    }

    /**
     * @param Version $version
     * @return Subject
     */
    public function removeVersion(Version $version): self
    {
        if($this->versions->contains($version)){
            $this->versions->removeElement($version);

            if($version->getSubjects()->contains($this)){
                $version->removeSubject($this);
            }
        }

        return $this;
    }


    /**
     * Get Images
     * @return Collection|null
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * Add an image
     * @param Image $image;
     * @return Subject
     */
    public function addImage(Image $image): self
    {
        if(!$this->images->contains($image)){
            // Add an image
            $this->images->add($image);

            if($image->getSubject() !== $this){
                // Add a reference to the image
                $image->setSubject($this);
            }
        }

        return $this;
    }

    /**
     * Remove an image
     * @param Image $image
     * @return Subject
     */
    public function removeImage(Image $image): self
    {
        if($this->images->contains($image)){
            // Remove an image
            $this->images->removeElement($image);

            // Remove the reference to the subject
            if($image->getSubject() === $this){

                $image->setSubject(null);
            }
        }

        return $this;
    }
}
