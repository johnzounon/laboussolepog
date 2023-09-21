<?php

namespace App\Entity;

use App\Repository\AnneeAcademiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeAcademiqueRepository::class)]
class AnneeAcademique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $date_debut = null;

    #[ORM\Column]
    private ?int $date_fin = null;

    #[ORM\Column]
    private ?bool $annee_encours = null;

    #[ORM\OneToMany(mappedBy: 'annee_academique', targetEntity: Carnet::class, orphanRemoval: true)]
    private Collection $carnets;

    #[ORM\OneToMany(mappedBy: 'annee_academique', targetEntity: ArrieresAnterieure::class, orphanRemoval: true)]
    private Collection $arrieresAnterieures;

    public function __construct()
    {
        $this->carnets = new ArrayCollection();
        $this->arrieresAnterieures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?int
    {
        return $this->date_debut;
    }

    public function setDateDebut(int $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?int
    {
        return $this->date_fin;
    }

    public function setDateFin(int $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function isAnneeEncours(): ?bool
    {
        return $this->annee_encours;
    }

    public function setAnneeEncours(bool $annee_encours): static
    {
        $this->annee_encours = $annee_encours;

        return $this;
    }

    /**
     * @return Collection<int, Carnet>
     */
    public function getCarnets(): Collection
    {
        return $this->carnets;
    }

    public function addCarnet(Carnet $carnet): static
    {
        if (!$this->carnets->contains($carnet)) {
            $this->carnets->add($carnet);
            $carnet->setAnneeAcademique($this);
        }

        return $this;
    }

    public function removeCarnet(Carnet $carnet): static
    {
        if ($this->carnets->removeElement($carnet)) {
            // set the owning side to null (unless already changed)
            if ($carnet->getAnneeAcademique() === $this) {
                $carnet->setAnneeAcademique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArrieresAnterieure>
     */
    public function getArrieresAnterieures(): Collection
    {
        return $this->arrieresAnterieures;
    }

    public function addArrieresAnterieure(ArrieresAnterieure $arrieresAnterieure): static
    {
        if (!$this->arrieresAnterieures->contains($arrieresAnterieure)) {
            $this->arrieresAnterieures->add($arrieresAnterieure);
            $arrieresAnterieure->setAnneeAcademique($this);
        }

        return $this;
    }

    public function removeArrieresAnterieure(ArrieresAnterieure $arrieresAnterieure): static
    {
        if ($this->arrieresAnterieures->removeElement($arrieresAnterieure)) {
            // set the owning side to null (unless already changed)
            if ($arrieresAnterieure->getAnneeAcademique() === $this) {
                $arrieresAnterieure->setAnneeAcademique(null);
            }
        }

        return $this;
    }
}
