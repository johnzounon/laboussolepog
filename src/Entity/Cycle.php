<?php

namespace App\Entity;

use App\Repository\CycleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CycleRepository::class)]
class Cycle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'cycle', targetEntity: ClassePrimaire::class, orphanRemoval: true)]
    private Collection $classePrimaires;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    public function __construct()
    {
        $this->classePrimaires = new ArrayCollection();
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

    /**
     * @return Collection<int, ClassePrimaire>
     */
    public function getClassePrimaires(): Collection
    {
        return $this->classePrimaires;
    }

    public function addClassePrimaire(ClassePrimaire $classePrimaire): static
    {
        if (!$this->classePrimaires->contains($classePrimaire)) {
            $this->classePrimaires->add($classePrimaire);
            $classePrimaire->setCycle($this);
        }

        return $this;
    }

    public function removeClassePrimaire(ClassePrimaire $classePrimaire): static
    {
        if ($this->classePrimaires->removeElement($classePrimaire)) {
            // set the owning side to null (unless already changed)
            if ($classePrimaire->getCycle() === $this) {
                $classePrimaire->setCycle(null);
            }
        }

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }
}
