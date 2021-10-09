<?php

namespace App\Entity;

use App\Repository\SeanceCoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SeanceCoursRepository::class)
 */
class SeanceCours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enseignant;

    /**
     * @ORM\ManyToMany(targetEntity=Candidat::class, inversedBy="seanceCours")
     * 
     */
    private $candidat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startdateAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EnddateAt;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min=5, minMessage="La description doit etre supérieur à 5 caractére")
     */
    private $description;

  

    public function __construct()
    {
        $this->candidat = new ArrayCollection();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getEnseignant(): ?string
    {
        return $this->enseignant;
    }

    public function setEnseignant(string $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * @return Collection|Candidat[]
     */
    public function getCandidat(): Collection
    {
        return $this->candidat;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidat->contains($candidat)) {
            $this->candidat[] = $candidat;
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        $this->candidat->removeElement($candidat);

        return $this;
    }

    public function getStartdateAt(): ?\DateTimeInterface
    {
        return $this->startdateAt;
    }

    public function setStartdateAt(\DateTimeInterface $startdateAt): self
    {
        $this->startdateAt = $startdateAt;

        return $this;
    }

    public function getEnddateAt(): ?\DateTimeInterface
    {
        return $this->EnddateAt;
    }

    public function setEnddateAt(\DateTimeInterface $EnddateAt): self
    {
        $this->EnddateAt = $EnddateAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    

}
