<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'commentaire')]
    private ?Publication $publication = null;

    /**
     * @var Collection<int, reaction>
     */
    #[ORM\OneToMany(targetEntity: reaction::class, mappedBy: 'commentaire')]
    private Collection $reaction;

    public function __construct()
    {
        $this->reaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    public function setPublication(?Publication $publication): static
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * @return Collection<int, reaction>
     */
    public function getReaction(): Collection
    {
        return $this->reaction;
    }

    public function addReaction(reaction $reaction): static
    {
        if (!$this->reaction->contains($reaction)) {
            $this->reaction->add($reaction);
            $reaction->setCommentaire($this);
        }

        return $this;
    }

    public function removeReaction(reaction $reaction): static
    {
        if ($this->reaction->removeElement($reaction)) {
            // set the owning side to null (unless already changed)
            if ($reaction->getCommentaire() === $this) {
                $reaction->setCommentaire(null);
            }
        }

        return $this;
    }
}
