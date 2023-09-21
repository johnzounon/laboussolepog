<?php

namespace App\Entity;

use App\Repository\CarnetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarnetRepository::class)]
class Carnet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $groupe = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?bool $carnet_encours = null;

    #[ORM\ManyToOne(inversedBy: 'carnets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeAcademique $annee_academique = null;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: ScolariteCollege::class, orphanRemoval: true)]
    private Collection $scolariteColleges;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: ScolaritePrimaire::class, orphanRemoval: true)]
    private Collection $scolaritePrimaires;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: ArrieresCollege::class, orphanRemoval: true)]
    private Collection $arrieresColleges;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: ArrieresPrimaire::class, orphanRemoval: true)]
    private Collection $arrieresPrimaires;

    #[ORM\OneToMany(mappedBy: 'carnet', targetEntity: Tenue::class, orphanRemoval: true)]
    private Collection $tenues;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->scolariteColleges = new ArrayCollection();
        $this->scolaritePrimaires = new ArrayCollection();
        $this->arrieresColleges = new ArrayCollection();
        $this->arrieresPrimaires = new ArrayCollection();
        $this->tenues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): static
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function isCarnetEncours(): ?bool
    {
        return $this->carnet_encours;
    }

    public function setCarnetEncours(bool $carnet_encours): static
    {
        $this->carnet_encours = $carnet_encours;

        return $this;
    }

    public function getAnneeAcademique(): ?AnneeAcademique
    {
        return $this->annee_academique;
    }

    public function setAnneeAcademique(?AnneeAcademique $annee_academique): static
    {
        $this->annee_academique = $annee_academique;

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
            $inscription->setCarnet($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getCarnet() === $this) {
                $inscription->setCarnet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ScolariteCollege>
     */
    public function getScolariteColleges(): Collection
    {
        return $this->scolariteColleges;
    }

    public function addScolariteCollege(ScolariteCollege $scolariteCollege): static
    {
        if (!$this->scolariteColleges->contains($scolariteCollege)) {
            $this->scolariteColleges->add($scolariteCollege);
            $scolariteCollege->setCarnet($this);
        }

        return $this;
    }

    public function removeScolariteCollege(ScolariteCollege $scolariteCollege): static
    {
        if ($this->scolariteColleges->removeElement($scolariteCollege)) {
            // set the owning side to null (unless already changed)
            if ($scolariteCollege->getCarnet() === $this) {
                $scolariteCollege->setCarnet(null);
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
            $scolaritePrimaire->setCarnet($this);
        }

        return $this;
    }

    public function removeScolaritePrimaire(ScolaritePrimaire $scolaritePrimaire): static
    {
        if ($this->scolaritePrimaires->removeElement($scolaritePrimaire)) {
            // set the owning side to null (unless already changed)
            if ($scolaritePrimaire->getCarnet() === $this) {
                $scolaritePrimaire->setCarnet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArrieresCollege>
     */
    public function getArrieresColleges(): Collection
    {
        return $this->arrieresColleges;
    }

    public function addArrieresCollege(ArrieresCollege $arrieresCollege): static
    {
        if (!$this->arrieresColleges->contains($arrieresCollege)) {
            $this->arrieresColleges->add($arrieresCollege);
            $arrieresCollege->setCarnet($this);
        }

        return $this;
    }

    public function removeArrieresCollege(ArrieresCollege $arrieresCollege): static
    {
        if ($this->arrieresColleges->removeElement($arrieresCollege)) {
            // set the owning side to null (unless already changed)
            if ($arrieresCollege->getCarnet() === $this) {
                $arrieresCollege->setCarnet(null);
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
            $arrieresPrimaire->setCarnet($this);
        }

        return $this;
    }

    public function removeArrieresPrimaire(ArrieresPrimaire $arrieresPrimaire): static
    {
        if ($this->arrieresPrimaires->removeElement($arrieresPrimaire)) {
            // set the owning side to null (unless already changed)
            if ($arrieresPrimaire->getCarnet() === $this) {
                $arrieresPrimaire->setCarnet(null);
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
            $tenue->setCarnet($this);
        }

        return $this;
    }

    public function removeTenue(Tenue $tenue): static
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getCarnet() === $this) {
                $tenue->setCarnet(null);
            }
        }

        return $this;
    }
}
