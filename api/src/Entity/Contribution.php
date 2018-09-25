<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_contribution")
 * @ORM\Entity(repositoryClass="App\Repository\ContributionRepository")
 */
class Contribution
{
    /**
     * @var integer ID of the contribution
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string Title of the contribution (optional).
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string Content of the contribution.
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var int $rating Rating of the contribution
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $rating;

    /**
     * @var Datetime Date of the contribution
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var DateTime Date of the last modification of the contribution
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var Editor $editor Editor who made this contribution
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="contributionsMade")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $editor;

    /**
     * @var Group $group Group in which the editor has the privileges to access this subject
     * @ORM\ManyToOne(targetEntity="Group", cascade={"persist"}, inversedBy="contributions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    /**
     * @var Subject $subject Subject which is concerned by this contribution
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"}, inversedBy="contributionsSuggested")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $subject;

    /**
     * @var Collection $abuses Reported abuses on this contribution
     * @ORM\OneToMany(targetEntity="Abuse", mappedBy="contribution")
     * @Assert\Collection()
     */
    private $abuses;

    /**
     * Contribution constructor.
     */
    public function __construct()
    {
        $this->abuses = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
     * @param null|string $title
     * @return Contribution
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
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
     * @return Contribution
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return self
     */
    public function setRating(int $rating): self
    {
        $this->rating = $rating;

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
     * @return Contribution
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param \DateTimeInterface|null $dateModified
     * @return Contribution
     */
    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get Editor
     * @return Editor|null
     */
    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    /**
     * Set Editor
     *
     * @param Editor|null $editor
     * @return Contribution
     */
    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        if($editor !== null){
            $editor->addContributionMade($this);
        }
        return $this;
    }

    /**
     * @return Group|null
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * @param Group|null $group
     * @return Contribution
     */
    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        if(!is_null($group) && !$group->getContributions()->contains($this)){
            $group->addContribution($this);
        }

        return $this;
    }



    /**
     * Get the subject
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * Set the subject
     * @param Subject|null $subject
     * @return Contribution
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        if(!is_null($subject) && !$subject->getContributionsSuggested()->contains($this)){
            $subject->addContributionsSuggested($this);
        }

        return $this;
    }

    /**
     * Get abuses
     * @return Collection
     */
    public function getAbuses(): Collection
    {
        return $this->abuses;
    }

    /**
     * Add an abuse
     * @param Abuse $abuse
     * @return Contribution
     */
    public function addAbuse(Abuse $abuse): self
    {
        if(!$this->abuses->contains($abuse)){
            $this->abuses->add($abuse);

            // Add a reference to this contribution on this abuse object
            if($abuse->getContribution() !== $this){
                $abuse->setContribution($this);
            }
        }

        return $this;
    }

    /**
     * Remove an abuse
     * @param Abuse $abuse
     * @return Contribution
     */
    public function removeAbuse(Abuse $abuse): self
    {
        if($this->abuses->contains($abuse)){
            // remove the abuse
            $this->abuses->removeElement($abuse);

            // remove the reference
            if($abuse->getContribution() === $this){
                $abuse->setContribution(null);
            }
        }

        return $this;
    }



}
