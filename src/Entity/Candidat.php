<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 * @UniqueEntity("email", message="cette adress email est déja utilisé")
 * @UniqueEntity("cin", message="Ce numéro CIN est déja utilisé")
 */
class Candidat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * 
     * 
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(min=8, max=8, minMessage="Le numéro de télèphone doit etre de 8 chiffres",
     * maxMessage="Le numéro de télèphone doit etre de 8 chiffres")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="L'adress doit étre au minimum de 4 caractére")
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="candidats")
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "Cette adress '{{ value }}' est incorrect."
     * )
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity=SeanceCours::class, mappedBy="candidat")
     */
    private $seanceCours;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
        $this->seanceCours = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRegistrationAt(): ?\DateTimeInterface
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(\DateTimeInterface $registrationAt): self
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        $this->formation->removeElement($formation);

        return $this;
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

    
    public function __toString()
    {
        return $this->firstname;
        
    }

    /**
     * @return Collection|SeanceCours[]
     */
    public function getSeanceCours(): Collection
    {
        return $this->seanceCours;
    }

    public function addSeanceCour(SeanceCours $seanceCour): self
    {
        if (!$this->seanceCours->contains($seanceCour)) {
            $this->seanceCours[] = $seanceCour;
            $seanceCour->addCandidat($this);
        }

        return $this;
    }

    public function removeSeanceCour(SeanceCours $seanceCour): self
    {
        if ($this->seanceCours->removeElement($seanceCour)) {
            $seanceCour->removeCandidat($this);
        }

        return $this;
    }

  

  
}
