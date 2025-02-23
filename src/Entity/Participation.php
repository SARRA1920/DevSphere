<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Events")]
    #[ORM\JoinColumn(name: "id_e", referencedColumnName: "id")]
    private ?Events $idE = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User", cascade: ["persist"])]  // Add cascade={"persist"}
    #[ORM\JoinColumn(name: "id_u", referencedColumnName: "id")]
    private ?User $idU = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdE(): ?Events
    {
        return $this->idE;
    }

    public function setIdE(?Events $idE): static
    {
        $this->idE = $idE;

        return $this;
    }

    public function getIdU(): ?User
    {
        return $this->idU;
    }

    public function setIdU(?User $idU): static
    {
        $this->idU = $idU;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'Participation (ID: %d) - User: %s %s, Event: %s',
            $this->id ?? 0,
            $this->idU ? $this->idU->getPrenom() : 'Unknown',
            $this->idU ? $this->idU->getNom() : 'Unknown',
            $this->idE ? $this->idE->getTitle() : 'Unknown Event'
        );
    }

}
