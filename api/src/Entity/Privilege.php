<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_privilege")
 * @ORM\Entity(repositoryClass="App\Repository\PrivilegesRepository")
 */
class Privilege
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var Group $group Group which has the privilege
     * @ORM\ManyToOne(targetEntity="Group", cascade={"persist","remove"}, inversedBy="privileges")
     * @ORM\JoinColumn(nullable=true)
     */
    private $group;

    /**
     * @var Subject $subject Subject concerned by the privilege
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist","remove"}, inversedBy="privileges")
     * @ORM\JoinColumn(nullable=true)
     */
    private $subject;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @return Privilege
     */
    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        if($group !== null){
            $group->addPrivilege($this);
        }

        return $this;
    }

    /**
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject|null $subject
     * @return Privilege
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        if(!is_null($subject)){
            $subject->addPrivilege($this);
        }

        return $this;
    }


}
