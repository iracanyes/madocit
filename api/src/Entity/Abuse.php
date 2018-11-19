<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *
 * )
 * @ORM\Table(name="mdit_abuse")
 * @ORM\Entity(repositoryClass="App\Repository\AbuseRepository")
 */
class Abuse
{
    /**
     * @var integer ID of the abuse
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type(
     *     type="integer",
     *     message="The value '{{ value }}' is not a valid type. Type : {{ type }} needed!"
     * )
     */
    private $id;

    /**
     * @var string $type Type of the abuse
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string Description of the abuse
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var Datetime Date of the creation of the abuse
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var Editor Editor who identify the abuse
     *
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="abusesIdentified")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $accuser;

    /**
     * @var Editor  $defendant Charged person
     *
     *
     * @ORM\ManyToOne(targetEntity="Editor", cascade={"persist"}, inversedBy="abusesAccused")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $defendant;

    /**
     * @var Message $message Message that contains the abuse
     *
     * @ORM\ManyToOne(targetEntity="Message", cascade={"persist"}, inversedBy="abuses")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Message")
     */
    private $message;

    /**
     * @var Contribution $contribution Contribution that contains the abuse
     *
     * @ORM\ManyToOne(targetEntity="Contribution", cascade={"persist","remove"}, inversedBy="abuses")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Contribution")
     */
    private $contribution;

    /**
     *
     * @var Sanction Sanction for this abuse
     *
     * @ORM\ManyToOne(targetEntity="Sanction", cascade={"persist","remove"}, inversedBy="abuses")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Sanction")
     */
    private $sanction;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @param string $description
     * @return Abuse
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Editor
     */
    public function getAccuser(): ?Editor
    {
        return $this->accuser;
    }

    /**
     * @param Editor|null $accuser
     * @return self
     */
    public function setAccuser(?Editor $accuser): self
    {
        $this->accuser = $accuser;

        if(!is_null($accuser) && !$accuser->getAbusesIdentified()->contains($this)){
            $accuser->addAbuseIdentified($this);
        }

        return $this;
    }

    /**
     * @return Editor|null
     */
    public function getDefendant(): ?Editor
    {
        return $this->defendant;
    }

    /**
     * @param Editor $defendant
     * @return self
     */
    public function setDefendant(?Editor $defendant): self
    {
        $this->defendant = $defendant;

        if(!is_null($defendant) && !$defendant->getAbusesAccused()->contains($this)){
            $defendant->addAbuseAccused($this);
        }

        return $this;
    }

    /**
     * @return Message|null
     */
    public function getMessage(): ?Message
    {
        return $this->message;
    }

    /**
     * @param Message|null $message
     * @return Abuse
     */
    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        if(!is_null($message) && !$message->getAbuses()->contains($this)){
            $message->addAbuse($this);
        }

        return $this;
    }

    /**
     * @return Sanction|null
     */
    public function getSanction(): ?Sanction
    {
        return $this->sanction;
    }

    /**
     * @param Sanction|null $sanction
     * @return self
     */
    public function setSanction(?Sanction $sanction): self
    {
        $this->sanction = $sanction;

        if(!is_null($sanction) && !$sanction->getAbuses()->contains($this)){
            $sanction->addAbuse($this);
        }

        return $this;
    }

    /**
     * @return Contribution
     */
    public function getContribution(): ?Contribution
    {
        return $this->contribution;
    }

    /**
     * @param Contribution $contribution
     * @return self
     */
    public function setContribution(Contribution $contribution): self
    {
        $this->contribution = $contribution;

        if(!is_null($contribution) && !$contribution->getAbuses()->contains($this)){
            $contribution->addAbuse($this);
        }

        return $this;
    }




}
