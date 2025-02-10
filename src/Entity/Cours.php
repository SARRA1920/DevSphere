<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Niveau = null;

    #[ORM\Column(length: 255)]
    private ?string $Durée = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Inscription $inscription = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Categoriecours $categoriecours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->Niveau;
    }

    public function setNiveau(string $Niveau): static
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getDurée(): ?string
    {
        return $this->Durée;
    }

    public function setDurée(string $Durée): static
    {
        $this->Durée = $Durée;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getCategoriecours(): ?Categoriecours
    {
        return $this->categoriecours;
    }

    public function setCategoriecours(?Categoriecours $categoriecours): static
    {
        $this->categoriecours = $categoriecours;

        return $this;
    }
}
