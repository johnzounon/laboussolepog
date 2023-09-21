<?php

namespace App\Entity;

use App\Repository\ClasseCollegeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseCollegeRepository::class)]
class ClasseCollege
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'classeColleges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CycleCollege $cycle = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    #[ORM\OneToMany(mappedBy: 'classe_college', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: ScolariteCollege::class, orphanRemoval: true)]
    private Collection $scolariteColleges;

    #[ORM\OneToMany(mappedBy: 'classe_college', targetEntity: ArrieresAnterieure::class)]
    private Collection $arrieresAnterieures;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: ArrieresCollege::class, orphanRemoval: true)]
    private Collection $arrieresColleges;

    #[ORM\OneToMany(mappedBy: 'classe_college', targetEntity: Tenue::class)]
    private Collection $tenues;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->scolariteColleges = new ArrayCollection();
        $this->arrieresAnterieures = new ArrayCollection();
        $this->arrieresColleges = new ArrayCollection();
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

    public function getCycle(): ?CycleCollege
    {
        return $this->cycle;
    }

    public function setCycle(?CycleCollege $cycle): static
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
            $inscription->setClasseCollege($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasseCollege() === $this) {
                $inscription->setClasseCollege(null);
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
            $scolariteCollege->setClasse($this);
        }

        return $this;
    }

    public function removeScolariteCollege(ScolariteCollege $scolariteCollege): static
    {
        if ($this->scolariteColleges->removeElement($scolariteCollege)) {
            // set the owning side to null (unless already changed)
            if ($scolariteCollege->getClasse() === $this) {
                $scolariteCollege->setClasse(null);
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
            $arrieresAnterieure->setClasseCollege($this);
        }

        return $this;
    }

    public function removeArrieresAnterieure(ArrieresAnterieure $arrieresAnterieure): static
    {
        if ($this->arrieresAnterieures->removeElement($arrieresAnterieure)) {
            // set the owning side to null (unless already changed)
            if ($arrieresAnterieure->getClasseCollege() === $this) {
                $arrieresAnterieure->setClasseCollege(null);
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
            $arrieresCollege->setClasse($this);
        }

        return $this;
    }

    public function removeArrieresCollege(ArrieresCollege $arrieresCollege): static
    {
        if ($this->arrieresColleges->removeElement($arrieresCollege)) {
            // set the owning side to null (unless already changed)
            if ($arrieresCollege->getClasse() === $this) {
                $arrieresCollege->setClasse(null);
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
            $tenue->setClasseCollege($this);
        }

        return $this;
    }

    public function removeTenue(Tenue $tenue): static
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getClasseCollege() === $this) {
                $tenue->setClasseCollege(null);
            }
        }

        return $this;
    }
}
