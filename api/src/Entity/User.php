<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mdit_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * Héritage de cette classe : Chaque éditeur est un utilisateur
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string", length=255)
 * @ORM\DiscriminatorMap({"user" = "User", "editor" = "Editor"})
 */
class User
{
    /**
     * @var integer ID of the user
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Email of the user
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string Encrypted password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var string Plain password
     * @ORM\Column(type="string", length=255)
     */
    private $plainPassword;

    /**
     * @var  integer Number of error on connection
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nbErrorConnection;

    /**
     * @var boolean User is banned
     * @ORM\Column(type="boolean")
     */
    private $banned;

    /**
     * @var boolean User confirmed his signin
     * @ORM\Column(type="boolean")
     */
    private $signinConfirmed;

    /**
     * @var \DateTime Date of the registration
     * @ORM\Column(type="datetime")
     */
    private $dateRegistration;

    /**
     * @var string API Token of the user
     * @ORM\Column(type="string", length=255)
     */
    private $apiToken;

    /**
     * @var Image Image representing the user
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getNbErrorConnection(): ?string
    {
        return $this->nbErrorConnection;
    }

    public function setNbErrorConnection(?string $nbErrorConnection): self
    {
        $this->nbErrorConnection = $nbErrorConnection;

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getSigninConfirmed(): ?bool
    {
        return $this->signinConfirmed;
    }

    public function setSigninConfirmed(bool $signinConfirmed): self
    {
        $this->signinConfirmed = $signinConfirmed;

        return $this;
    }

    public function getDateRegistration(): ?\DateTimeInterface
    {
        return $this->dateRegistration;
    }

    public function setDateRegistration(\DateTimeInterface $dateRegistration): self
    {
        $this->dateRegistration = $dateRegistration;

        return $this;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function setApiToken(string $apiToken): self
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image): void
    {
        $this->image = $image;
    }


}
