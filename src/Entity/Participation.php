<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participation')]
    private ?User $user = null;

    /**
     * @var Collection<int, events>
     */
    #[ORM\OneToMany(targetEntity: events::class, mappedBy: 'participation')]
    private Collection $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, events>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(events $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setParticipation($this);
        }

        return $this;
    }

    public function removeEvent(events $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getParticipation() === $this) {
                $event->setParticipation(null);
            }
        }

        return $this;
    }
}
