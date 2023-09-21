<?php

namespace App\Entity;

use App\Repository\CycleCollegeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CycleCollegeRepository::class)]
class CycleCollege
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'cycle', targetEntity: ClasseCollege::class, orphanRemoval: true)]
    private Collection $classeColleges;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    public function __construct()
    {
        $this->classeColleges = new ArrayCollection();
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
     * @return Collection<int, ClasseCollege>
     */
    public function getClasseColleges(): Collection
    {
        return $this->classeColleges;
    }

    public function addClasseCollege(ClasseCollege $classeCollege): static
    {
        if (!$this->classeColleges->contains($classeCollege)) {
            $this->classeColleges->add($classeCollege);
            $classeCollege->setCycle($this);
        }

        return $this;
    }

    public function removeClasseCollege(ClasseCollege $classeCollege): static
    {
        if ($this->classeColleges->removeElement($classeCollege)) {
            // set the owning side to null (unless already changed)
            if ($classeCollege->getCycle() === $this) {
                $classeCollege->setCycle(null);
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
