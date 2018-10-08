<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="mdit_admin")
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin extends Editor
{
    /**
     * @var integer ID of the admin
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * @var integer Number of users banned by the admin
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("integer")
     */
    private $nbUsersBanned;

    /**
     * @var Collection Editors banned by this admin
     *
     * From Doctrine's point of view, it is simply mapped as a unidirectional many-to-many whereby a unique constraint on one of the join columns enforces the one-to-many cardinality. https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-unidirectional-with-join-table
     *
     * @ORM\ManyToMany(targetEntity="User", cascade={"persist"})
     * @ORM\JoinTable(
     *     name="mdit_users_banned",
     *     joinColumns={@ORM\JoinColumn(name="admin_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true)}
     *
     * )
     * @ApiSubresource()
     * @Assert\Collection()
     */
    private $usersBanned;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->usersBanned = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNbUsersBanned(): ?int
    {
        return $this->nbUsersBanned;
    }

    public function setNbUsersBanned(?int $nbUsersBanned): self
    {
        $this->nbUsersBanned = $nbUsersBanned;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsersBanned(): Collection
    {
        return $this->usersBanned;
    }

    /**
     * @param User $user
     * @return self
     */
    public function addUsersBanned(User $user): self
    {
        if(!$this->usersBanned->contains($user)){
            // Add the user
            $this->usersBanned->add($user);

            // Mark the user as banned
            if($user->isBanned() !== true){
                $user->setBanned(true);
            }

        }

        return $this;
    }

    /**
     * Remove the user as banned
     * @param User $user
     * @return self
     */
    public function removeUsersBanned(User $user): self
    {
        if($this->usersBanned->contains($user)){
            // Remove the user from the banned users
            $this->usersBanned->removeElement($user);

            // Remove the user's mark as banned
            if($user->isBanned() === true){
                $user->setBanned(false);
            }
        }

        return $this;
    }

}
