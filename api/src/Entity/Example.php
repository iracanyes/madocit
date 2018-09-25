<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="mdit_example")
 * @ORM\Entity(repositoryClass="App\Repository\ExampleRepository")
 */
class Example
{
    /**
     * @var integer ID of the example
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string Title of the example
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string Content of the example
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var integer Average votes made by other users
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min=0,
     *     max=5,
     *     minMessage="The minimumm rate for vote is {{ limit }}. \n Your rate's value is {{ value }} !",
     *     maxMessage="The maximumm rate for vote is {{ limit }}. \n Your rate's value is {{ value }} !"
     * )
     */
    private $rating;

    /**
     * @var \Datetime Date of creation
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var \Datetime Date of the last modification
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateModified;

    /**
     * @var string URL of the pdf
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $pdf;

    /**
     * @var Collection $subjects Subject illustrated in this example
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="examples")
     * @Assert\Type("Doctrine\Common\Collections\Collection")
     */
    private $subjects;

    /**
     * @var Collection $images Images illustrating the example
     * @ORM\OneToMany(targetEntity="Image", mappedBy="example")
     */
    private $images;

    /**
     * @var Video Video associated to the example
     *
     * @ORM\OneToOne(targetEntity="Video", cascade={"persist","remove"}, inversedBy="associatedExample")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Type("App\Entity\Video")
     */
    private $video;

    /**
     * Example constructor.
     */
    public function __construct()
    {
        $this->subjects = $this->images = new ArrayCollection();
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
     * @param string $title
     * @return Example
     */
    public function setTitle(string $title): self
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
     * @return Example
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return Example
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
     * @return Example
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
     * @return Example
     */
    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    /**
     * @param null|string $pdf
     * @return Example
     */
    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    /**
     * @param Subject $subject
     * @return Example
     */
    public function addSubject(Subject $subject): self
    {
        if(!$this->subjects->contains($subject)){

            $this->subjects->add($subject);

            if(!$subject->getExamples()->contains($this)){
                $subject->getExamples()->add($this);
            }

        }

        return $this;
    }

    /**
     * Remove a subject
     * @param Subject $subject
     * @return Example
     */
    public function removeSubject(Subject $subject): self
    {
        if($this->subjects->contains($subject)){
            // Remove
            $this->subjects->removeElement($subject);

            if($subject->getExamples()->contains($this)){
                $subject->getExamples()->removeElement($this);
            }
        }

        return $this;
    }



    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     * @return Example
     */
    public function addImage(Image $image): self
    {
        if(!$this->images->contains($image)){
            // Add an image
            $this->images->add($image);

            // Add a reference
            if($image->getExample() !== $this){
                $image->setExample($this);
            }
        }

        return $this;
    }

    /**
     * Remove an image
     * @param Image $image
     * @return Example
     */
    public function removeImage(Image $image): self
    {
        if($this->images->contains($image)){
            // Remove
            $this->images->removeElement($image);

            // Remove the reference to this example
            if($image->getExample() === $this){
                $image->setExample(null);
            }
        }

        return $this;
    }




    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video|null $video
     * @return Example
     */
    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }


}
