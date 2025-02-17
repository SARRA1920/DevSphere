<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire')]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le titre doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères'
    )]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le niveau de difficulté est obligatoire')]
    #[Assert\Choice(
        choices: ['facile', 'moyen', 'difficile'],
        message: 'Choisissez un niveau de difficulté valide : facile, moyen ou difficile'
    )]
    private ?string $niveauDifficulte = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'La note minimale est obligatoire')]
    #[Assert\Range(
        min: 0,
        max: 20,
        notInRangeMessage: 'La note minimale doit être comprise entre {{ min }} et {{ max }}'
    )]
    private ?float $noteMinimale = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le temps estimé est obligatoire')]
    #[Assert\Positive(message: 'Le temps estimé doit être positif')]
    #[Assert\LessThan(
        value: 481,
        message: 'Le temps estimé ne peut pas dépasser 8 heures (480 minutes)'
    )]
    private ?int $tempsEstime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichierPdf = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le type est obligatoire')]
    #[Assert\Choice(
        choices: ['quiz', 'pratique', 'devoir'],
        message: 'Choisissez un type valide : quiz, pratique ou devoir'
    )]
    private ?string $type = null;

    #[ORM\Column(length: 50)]
    private ?string $type_exercice = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $solution = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $criteres_evaluation = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?User $user = null;

    /**
     * @var Collection<int, Tentative>
     */
    #[ORM\OneToMany(targetEntity: Tentative::class, mappedBy: 'exercice')]
    private Collection $tentatives;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
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
        return $this->niveauDifficulte;
    }

    public function setNiveauDifficulte(string $niveauDifficulte): static
    {
        $this->niveauDifficulte = $niveauDifficulte;
        return $this;
    }

    public function getNoteMinimale(): ?float
    {
        return $this->noteMinimale;
    }

    public function setNoteMinimale(float $noteMinimale): static
    {
        $this->noteMinimale = $noteMinimale;
        return $this;
    }

    public function getTempsEstime(): ?int
    {
        return $this->tempsEstime;
    }

    public function setTempsEstime(int $tempsEstime): static
    {
        $this->tempsEstime = $tempsEstime;
        return $this;
    }

    public function getFichierPdf(): ?string
    {
        return $this->fichierPdf;
    }

    public function setFichierPdf(?string $fichierPdf): static
    {
        $this->fichierPdf = $fichierPdf;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getTypeExercice(): ?string
    {
        return $this->type_exercice;
    }

    public function setTypeExercice(string $type_exercice): static
    {
        $this->type_exercice = $type_exercice;
        return $this;
    }

    public function getSolution(): ?string
    {
        return $this->solution;
    }

    public function setSolution(string $solution): static
    {
        $this->solution = $solution;
        return $this;
    }

    public function getCriteresEvaluation(): ?string
    {
        return $this->criteres_evaluation;
    }

    public function setCriteresEvaluation(?string $criteres_evaluation): static
    {
        $this->criteres_evaluation = $criteres_evaluation;
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
     * @return Collection<int, Tentative>
     */
    public function getTentatives(): Collection
    {
        return $this->tentatives;
    }

    public function addTentative(Tentative $tentative): static
    {
        if (!$this->tentatives->contains($tentative)) {
            $this->tentatives->add($tentative);
            $tentative->setExercice($this);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): static
    {
        if ($this->tentatives->removeElement($tentative)) {
            // set the owning side to null (unless already changed)
            if ($tentative->getExercice() === $this) {
                $tentative->setExercice(null);
            }
        }

        return $this;
    }
}
