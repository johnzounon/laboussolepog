<?php

namespace App\Entity;

use App\Repository\ClassePrimaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassePrimaireRepository::class)]
class ClassePrimaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'classePrimaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cycle $cycle = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    #[ORM\OneToMany(mappedBy: 'classe_primaire', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: ScolaritePrimaire::class, orphanRemoval: true)]
    private Collection $scolaritePrimaires;

    #[ORM\OneToMany(mappedBy: 'classe_primaire', targetEntity: ArrieresAnterieure::class)]
    private Collection $arrieresAnterieures;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: ArrieresPrimaire::class, orphanRemoval: true)]
    private Collection $arrieresPrimaires;

    #[ORM\OneToMany(mappedBy: 'classe_primaire', targetEntity: Tenue::class)]
    private Collection $tenues;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->scolaritePrimaires = new ArrayCollection();
        $this->arrieresAnterieures = new ArrayCollection();
        $this->arrieresPrimaires = new ArrayCollection();
        $this->tenues = new ArrayCollection();
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

    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): static
    {
        $this->cycle = $cycle;

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

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setClassePrimaire($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClassePrimaire() === $this) {
                $inscription->setClassePrimaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ScolaritePrimaire>
     */
    public function getScolaritePrimaires(): Collection
    {
        return $this->scolaritePrimaires;
    }

    public function addScolaritePrimaire(ScolaritePrimaire $scolaritePrimaire): static
    {
        if (!$this->scolaritePrimaires->contains($scolaritePrimaire)) {
            $this->scolaritePrimaires->add($scolaritePrimaire);
            $scolaritePrimaire->setClasse($this);
        }

        return $this;
    }

    public function removeScolaritePrimaire(ScolaritePrimaire $scolaritePrimaire): static
    {
        if ($this->scolaritePrimaires->removeElement($scolaritePrimaire)) {
            // set the owning side to null (unless already changed)
            if ($scolaritePrimaire->getClasse() === $this) {
                $scolaritePrimaire->setClasse(null);
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
            $arrieresAnterieure->setClassePrimaire($this);
        }

        return $this;
    }

    public function removeArrieresAnterieure(ArrieresAnterieure $arrieresAnterieure): static
    {
        if ($this->arrieresAnterieures->removeElement($arrieresAnterieure)) {
            // set the owning side to null (unless already changed)
            if ($arrieresAnterieure->getClassePrimaire() === $this) {
                $arrieresAnterieure->setClassePrimaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArrieresPrimaire>
     */
    public function getArrieresPrimaires(): Collection
    {
        return $this->arrieresPrimaires;
    }

    public function addArrieresPrimaire(ArrieresPrimaire $arrieresPrimaire): static
    {
        if (!$this->arrieresPrimaires->contains($arrieresPrimaire)) {
            $this->arrieresPrimaires->add($arrieresPrimaire);
            $arrieresPrimaire->setClasse($this);
        }

        return $this;
    }

    public function removeArrieresPrimaire(ArrieresPrimaire $arrieresPrimaire): static
    {
        if ($this->arrieresPrimaires->removeElement($arrieresPrimaire)) {
            // set the owning side to null (unless already changed)
            if ($arrieresPrimaire->getClasse() === $this) {
                $arrieresPrimaire->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tenue>
     */
    public function getTenues(): Collection
    {
        return $this->tenues;
    }

    public function addTenue(Tenue $tenue): static
    {
        if (!$this->tenues->contains($tenue)) {
            $this->tenues->add($tenue);
            $tenue->setClassePrimaire($this);
        }

        return $this;
    }

    public function removeTenue(Tenue $tenue): static
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getClassePrimaire() === $this) {
                $tenue->setClassePrimaire(null);
            }
        }

        return $this;
    }
}
