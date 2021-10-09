<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $title;

 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $candidat;

    

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

    public function getCandidat(): ?string
    {
        return $this->candidat;
    }

    public function setCandidat(string $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }

    
    
    
}
