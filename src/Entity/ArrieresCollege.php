<?php

namespace App\Entity;

use App\Repository\ArrieresCollegeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArrieresCollegeRepository::class)]
class ArrieresCollege
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresColleges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClasseCollege $classe = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresColleges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ArrieresAnterieure $eleve = null;

    #[ORM\Column]
    private ?int $montant_chiffre = null;

    #[ORM\Column(length: 255)]
    private ?string $montant_lettre = null;

    #[ORM\Column(length: 255)]
    private ?string $tranche = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresColleges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\ManyToOne(inversedBy: 'arrieresColleges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carnet $carnet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?ClasseCollege
    {
        return $this->classe;
    }

    public function setClasse(?ClasseCollege $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getEleve(): ?ArrieresAnterieure
    {
        return $this->eleve;
    }

    public function setEleve(?ArrieresAnterieure $eleve): static
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
