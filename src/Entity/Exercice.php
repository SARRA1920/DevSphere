<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau_difficulte = null;

    #[ORM\ManyToOne(inversedBy: 'exercice')]
    private ?User $user = null;

    /**
     * @var Collection<int, tentative>
     */
    #[ORM\OneToMany(targetEntity: tentative::class, mappedBy: 'exercice')]
    private Collection $tentative;

    public function __construct()
    {
        $this->tentative = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNiveauDifficulte(): ?string
    {
        return $this->niveau_difficulte;
    }

    public function setNiveauDifficulte(string $niveau_difficulte): static
    {
        $this->niveau_difficulte = $niveau_difficulte;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, tentative>
     */
    public function getTentative(): Collection
    {
        return $this->tentative;
    }

    public function addTentative(tentative $tentative): static
    {
        if (!$this->tentative->contains($tentative)) {
            $this->tentative->add($tentative);
            $tentative->setExercice($this);
        }

        return $this;
    }

    public function removeTentative(tentative $tentative): static
    {
        if ($this->tentative->removeElement($tentative)) {
            // set the owning side to null (unless already changed)
            if ($tentative->getExercice() === $this) {
                $tentative->setExercice(null);
            }
        }

        return $this;
    }
}
