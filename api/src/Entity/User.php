<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="mdit_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * Héritage de cette classe : Chaque éditeur est un utilisateur
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "editor" = "Editor", "moderator"="Moderator", "admin"="Admin"})
 * @ UniqueEntity("email")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var integer ID of the user
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * ATTENTION: Avant la mise en production remettre la contrainte d'unicité
     * @var string Email of the user
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @var string Encrypted password
     * @ORM\Column(type="string", length=255)
     * @UserPassword()
     */
    protected $password;

    /**
     * @var string Plain password
     * @UserPassword()
     */
    protected $plainPassword;

    /**
     * @var  integer Number of error on connection
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min=0,
     *     max=6,
     *     minMessage="The minimumm number of errors on connection is {{ limit }}. \n The number's value is {{ value }} !",
     *     maxMessage="The maximumm number of errors on connection is {{ limit }}. \n The number's value is {{ value }} !"
     * )
     */
    protected $nbErrorConnection;

    /**
     * @var boolean User is banned
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    protected $banned;

    /**
     * @var boolean User confirmed his signin
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    protected $signinConfirmed;

    /**
     * @var \DateTime Date of the registration
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected $dateRegistration;


    /**
     * @var string API Token of the user
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    protected $apiToken;

    /**
     * @var array $roles Role of the user in the platform
     * @ORM\Column(type="json_array")
     */
    protected $roles;


    /**
     * @var Image Image representing the user
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"}, inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Image")
     */
    protected $image;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->roles  = array("ROLE_MEMBER");
    }

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

    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
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

    public function isBanned(): ?bool
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
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     */
    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }

    /**
     * Get Roles
     * @return array
     */
    public function getRoles(){

        $roles = $this->roles;

        // Ajout du rôle "ROLE_MEMBER"
        // Eviter les erreurs de $this->roles null
        //$roles[] = 'ROLE_MEMBER';

        return array_unique($roles);
    }

    /**
     * Set Roles
     * @param array $roles
     * @return self
     */
    public function setRoles(array $roles): self
    {

        $this->roles = $roles;

        return $this;

    }

    /**
     * Add Roles
     * @param array $role
     * @return User
     */


}
