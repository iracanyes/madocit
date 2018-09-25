<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_group")
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name Name of the group
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @var string Description of the group
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @var Editor $owner Owner of this group
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="groupsOwned")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Editor")
     */
    private $owner;

    /**
     * @var Collection $members Members of the group
     * @ORM\ManyToMany(targetEntity="Editor", cascade={"persist"}, inversedBy="groupsMember")
     * @ORM\JoinTable(name="mdit_group_member")
     * @ Assert\Collection()
     */
    private $members;

    /**
     * @var Collection $privileges Privileges owned by the group
     * @ORM\OneToMany(targetEntity="Privilege", mappedBy="group")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    private $privileges;

    /**
     * @var Collection $contributions Contributions made by the members of this group
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="group")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    private $contributions;

    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->members =
        $this->privileges =
        $this->contributions = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Editor
     */
    public function getOwner(): ?Editor
    {
        return $this->owner;
    }

    /**
     * Set Owner of this group
     * @param Editor|null $owner
     * @return Group
     */
    public function setOwner(?Editor $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @param Editor $editor
     * @return Group
     */
    public function addMember(Editor $editor): self
    {
        if(!$this->members->contains($editor)){

            $this->members->add($editor);

            if(!$editor->getGroupsMember()->contains($this)){
                $editor->addGroupsMember($this);
            }
        }

        return $this;
    }

    /**
     * Remove an editor from this group
     * @param Editor $editor
     * @return Group
     */
    public function removeMember(Editor $editor): self
    {
        if($this->members->contains($editor)){
            // Remove a member
            $this->members->removeElement($editor);

            // Remove a reference
            if($editor->getGroupsMember()->contains($this)){
                $editor->getGroupsMember()->removeElement($this);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getPrivileges(): Collection
    {
        return $this->privileges;
    }

    /**
     * @param Privilege $privilege
     * @return Group
     */
    public function addPrivilege(Privilege $privilege): self
    {
        if(!$this->privileges->contains($privilege)){

            $this->privileges->add($privilege);

            if($privilege->getGroup() !== $this){
                $privilege->setGroup($this);
            }
        }

        return $this;
    }

    /**
     * @param Privilege $privilege
     * @return Group
     */
    public function removePrivilege(Privilege $privilege): self
    {
        if($this->privileges->contains($privilege)){
            // Remove the privilege
            $this->privileges->removeElement($privilege);

            if($privilege->getGroup() === $this){
                $privilege->setGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getContributions(): Collection
    {
        return $this->contributions;
    }

    /**
     * @param Contribution $contribution
     * @return Group
     */
    public function addContribution(Contribution $contribution): self
    {
        if(!$this->contributions->contains($contribution)){
            $this->contributions->add($contribution);

            if($contribution->getGroup() !== $this){
                $contribution->setGroup($this);
            }
        }

        return $this;
    }

    /**
     * @param Contribution $contribution
     * @return Group
     */
    public function removeContribution(Contribution $contribution): self
    {
        if($this->contributions->contains($contribution)){
            $this->contributions->removeElement($contribution);

            if($contribution->getGroup() === $this){
                $contribution->setGroup(null);
            }
        }

        return $this;
    }




}
