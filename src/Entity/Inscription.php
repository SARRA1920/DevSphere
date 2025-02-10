<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateInscription = null;

    #[ORM\Column(length: 255)]
    private ?string $Statue = null;

    #[ORM\ManyToOne(inversedBy: 'inscription')]
    private ?User $idi = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?User $user = null;

    /**
     * @var Collection<int, cours>
     */
    #[ORM\OneToMany(targetEntity: cours::class, mappedBy: 'inscription')]
    private Collection $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->DateInscription;
    }

    public function setDateInscription(\DateTimeInterface $DateInscription): static
    {
        $this->DateInscription = $DateInscription;

        return $this;
    }

    public function getStatue(): ?string
    {
        return $this->Statue;
    }

    public function setStatue(string $Statue): static
    {
        $this->Statue = $Statue;

        return $this;
    }

    public function getIdi(): ?User
    {
        return $this->idi;
    }

    public function setIdi(?User $idi): static
    {
        $this->idi = $idi;

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
     * @return Collection<int, cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setInscription($this);
        }

        return $this;
    }

    public function removeCour(cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getInscription() === $this) {
                $cour->setInscription(null);
            }
        }

        return $this;
    }
}
