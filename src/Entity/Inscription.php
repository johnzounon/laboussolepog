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

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $montant_chiffre = null;

    #[ORM\Column(length: 255)]
    private ?string $montant_lettre = null;

    #[ORM\Column(length: 255)]
    private ?string $tuteur = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carnet $carnet = null;

    #[ORM\Column]
    private ?bool $avec_ram = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?ClassePrimaire $classe_primaire = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?ClasseCollege $classe_college = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: ScolariteCollege::class, orphanRemoval: true)]
    private Collection $scolariteColleges;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_complet = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: ScolaritePrimaire::class, orphanRemoval: true)]
    private Collection $scolaritePrimaires;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Tenue::class, orphanRemoval: true)]
    private Collection $tenues;

    public function __construct()
    {
        $this->scolariteColleges = new ArrayCollection();
        $this->scolaritePrimaires = new ArrayCollection();
        $this->tenues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMontantChiffre(): ?int
    {
        return $this->montant_chiffre;
    }

    public function setMontantChiffre(int $montant_chiffre): static
    {
        $this->montant_chiffre = $montant_chiffre;

        return $this;
    }

    public function getMontantLettre(): ?string
    {
        return $this->montant_lettre;
    }

    public function setMontantLettre(string $montant_lettre): static
    {
        $this->montant_lettre = $montant_lettre;

        return $this;
    }

    public function getTuteur(): ?string
    {
        return $this->tuteur;
    }

    public function setTuteur(string $tuteur): static
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

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

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getCarnet(): ?Carnet
    {
        return $this->carnet;
    }

    public function setCarnet(?Carnet $carnet): static
    {
        $this->carnet = $carnet;

        return $this;
    }

    public function isAvecRam(): ?bool
    {
        return $this->avec_ram;
    }

    public function setAvecRam(bool $avec_ram): static
    {
        $this->avec_ram = $avec_ram;

        return $this;
    }

    public function getClassePrimaire(): ?ClassePrimaire
    {
        return $this->classe_primaire;
    }

    public function setClassePrimaire(?ClassePrimaire $classe_primaire): static
    {
        $this->classe_primaire = $classe_primaire;

        return $this;
    }

    public function getClasseCollege(): ?ClasseCollege
    {
        return $this->classe_college;
    }

    public function setClasseCollege(?ClasseCollege $classe_college): static
    {
        $this->classe_college = $classe_college;

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
            $scolariteCollege->setEleve($this);
        }

        return $this;
    }

    public function removeScolariteCollege(ScolariteCollege $scolariteCollege): static
    {
        if ($this->scolariteColleges->removeElement($scolariteCollege)) {
            // set the owning side to null (unless already changed)
            if ($scolariteCollege->getEleve() === $this) {
                $scolariteCollege->setEleve(null);
            }
        }

        return $this;
    }

    public function getNomComplet(): ?string
    {
        return $this->nom_complet;
    }

    public function setNomComplet(?string $nom_complet): static
    {
        $this->nom_complet = $nom_complet;

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
            $scolaritePrimaire->setEleve($this);
        }

        return $this;
    }

    public function removeScolaritePrimaire(ScolaritePrimaire $scolaritePrimaire): static
    {
        if ($this->scolaritePrimaires->removeElement($scolaritePrimaire)) {
            // set the owning side to null (unless already changed)
            if ($scolaritePrimaire->getEleve() === $this) {
                $scolaritePrimaire->setEleve(null);
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
            $tenue->setEleve($this);
        }

        return $this;
    }

    public function removeTenue(Tenue $tenue): static
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getEleve() === $this) {
                $tenue->setEleve(null);
            }
        }

        return $this;
    }
}
