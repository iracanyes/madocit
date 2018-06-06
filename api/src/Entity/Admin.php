<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbUsersBanned;

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
}
