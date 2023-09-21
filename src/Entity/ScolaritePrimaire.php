<?php

namespace App\Entity;

use App\Repository\ScolaritePrimaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScolaritePrimaireRepository::class)]
class ScolaritePrimaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scolaritePrimaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClassePrimaire $classe = null;

    #[ORM\ManyToOne(inversedBy: 'scolaritePrimaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Inscription $eleve = null;

    #[ORM\Column]
    private ?int $montant_chiffre = null;

    #[ORM\Column(length: 255)]
    private ?string $montant_lettre = null;

    #[ORM\Column(length: 255)]
    private ?string $tranche = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'scolaritePrimaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\ManyToOne(inversedBy: 'scolaritePrimaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carnet $carnet = null;

    #[ORM\Column(nullable: true)]
    private ?int $tarif_mensuel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?ClassePrimaire
    {
        return $this->classe;
    }

    public function setClasse(?ClassePrimaire $classe): static
    {
        $this->classe = $classe;

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

    public function getTranche(): ?string
    {
        return $this->tranche;
    }

    public function setTranche(string $tranche): static
    {
        $this->tranche = $tranche;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate($date): static
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

    public function getTarifMensuel(): ?int
    {
        return $this->tarif_mensuel;
    }

    public function setTarifMensuel(?int $tarif_mensuel): static
    {
        $this->tarif_mensuel = $tarif_mensuel;

        return $this;
    }
}
