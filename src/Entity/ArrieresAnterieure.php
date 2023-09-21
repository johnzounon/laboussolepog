<?php

namespace App\Entity;

use App\Repository\ArrieresAnterieureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArrieresAnterieureRepository::class)]
class ArrieresAnterieure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresAnterieures')]
    private ?ClassePrimaire $classe_primaire = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresAnterieures')]
    private ?ClasseCollege $classe_college = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_complet = null;

    #[ORM\Column]
    private ?int $tarif_mensuel = null;

    #[ORM\Column]
    private ?int $montant_payer = null;

    #[ORM\Column]
    private ?int $montant_restant = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresAnterieures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeAcademique $annee_academique = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresAnterieures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: ArrieresPrimaire::class, orphanRemoval: true)]
    private Collection $arrieresPrimaires;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: ArrieresCollege::class, orphanRemoval: true)]
    private Collection $arrieresColleges;

    public function __construct()
    {
        $this->arrieresPrimaires = new ArrayCollection();
        $this->arrieresColleges = new ArrayCollection();
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

    public function getNomComplet(): ?string
    {
        return $this->nom_complet;
    }

    public function setNomComplet(string $nom_complet): static
    {
        $this->nom_complet = $nom_complet;

        return $this;
    }

    public function getTarifMensuel(): ?int
    {
        return $this->tarif_mensuel;
    }

    public function setTarifMensuel(int $tarif_mensuel): static
    {
        $this->tarif_mensuel = $tarif_mensuel;

        return $this;
    }

    public function getMontantPayer(): ?int
    {
        return $this->montant_payer;
    }

    public function setMontantPayer(int $montant_payer): static
    {
        $this->montant_payer = $montant_payer;

        return $this;
    }

    public function getMontantRestant(): ?int
    {
        return $this->montant_restant;
    }

    public function setMontantRestant(int $montant_restant): static
    {
        $this->montant_restant = $montant_restant;

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

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): static
    {
        $this->agent = $agent;

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
            $arrieresPrimaire->setEleve($this);
        }

        return $this;
    }

    public function removeArrieresPrimaire(ArrieresPrimaire $arrieresPrimaire): static
    {
        if ($this->arrieresPrimaires->removeElement($arrieresPrimaire)) {
            // set the owning side to null (unless already changed)
            if ($arrieresPrimaire->getEleve() === $this) {
                $arrieresPrimaire->setEleve(null);
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
            $arrieresCollege->setEleve($this);
        }

        return $this;
    }

    public function removeArrieresCollege(ArrieresCollege $arrieresCollege): static
    {
        if ($this->arrieresColleges->removeElement($arrieresCollege)) {
            // set the owning side to null (unless already changed)
            if ($arrieresCollege->getEleve() === $this) {
                $arrieresCollege->setEleve(null);
            }
        }

        return $this;
    }
}
