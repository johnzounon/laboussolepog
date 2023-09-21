<?php

namespace App\Entity;

use App\Repository\TenueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TenueRepository::class)]
class Tenue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tenues')]
    private ?ClassePrimaire $classe_primaire = null;

    #[ORM\ManyToOne(inversedBy: 'tenues')]
    private ?ClasseCollege $classe_college = null;

    #[ORM\ManyToOne(inversedBy: 'tenues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Inscription $eleve = null;

    #[ORM\Column]
    private ?int $montant_chiffre = null;

    #[ORM\Column(length: 255)]
    private ?string $montant_lettre = null;

    #[ORM\Column(length: 255)]
    private ?string $tenue = null;

    #[ORM\Column]
    private ?bool $livraison = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'tenues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\ManyToOne(inversedBy: 'tenues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carnet $carnet = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEleve(): ?Inscription
    {
        return $this->eleve;
    }

    public function setEleve(?Inscription $eleve): static
    {
        $this->eleve = $eleve;

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

    public function getTenue(): ?string
    {
        return $this->tenue;
    }

    public function setTenue(string $tenue): static
    {
        $this->tenue = $tenue;

        return $this;
    }

    public function isLivraison(): ?bool
    {
        return $this->livraison;
    }

    public function setLivraison(bool $livraison): static
    {
        $this->livraison = $livraison;

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
}
