<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre du cours est obligatoire")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "Le titre doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $titre = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "La description du cours est obligatoire")]
    #[Assert\Length(
        min: 10,
        minMessage: "La description doit contenir au moins {{ limit }} caractères"
    )]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La durée du cours est obligatoire")]
    #[Assert\Regex(
        pattern: "/^[0-9]+[hH]$/",
        message: "La durée doit être au format '2h' ou '2H'"
    )]
    private ?string $duree = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le niveau du cours est obligatoire")]
    #[Assert\Choice(
        choices: ["Beginner", "Intermediate", "Advanced", "Expert"],
        message: "Le niveau doit être 'Beginner', 'Intermediate', 'Advanced' ou 'Expert'"
    )]
    private ?string $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[Assert\NotNull(message: "La catégorie du cours est obligatoire")]
    private ?CategorieCours $categorieCours = null;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: InscriptionCours::class, orphanRemoval: true)]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;
        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function getCategorieCours(): ?CategorieCours
    {
        return $this->categorieCours;
    }

    public function setCategorieCours(?CategorieCours $categorieCours): static
    {
        $this->categorieCours = $categorieCours;
        return $this;
    }

    /**
     * @return Collection<int, InscriptionCours>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(InscriptionCours $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setCours($this);
        }

        return $this;
    }

    public function removeInscription(InscriptionCours $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getCours() === $this) {
                $inscription->setCours(null);
            }
        }

        return $this;
    }
}
