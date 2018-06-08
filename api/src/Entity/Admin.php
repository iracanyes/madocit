<?php

namespace App\Entity;

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
    private $id;

    /**
     * @var integer Number of users banned by the admin
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("integer")
     */
    private $nbUsersBanned;

    public function __construct()
    {
        parent::__construct();
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
}
