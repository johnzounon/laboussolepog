<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: ScolariteCollege::class, orphanRemoval: true)]
    private Collection $scolariteColleges;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: ScolaritePrimaire::class, orphanRemoval: true)]
    private Collection $scolaritePrimaires;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: ArrieresAnterieure::class, orphanRemoval: true)]
    private Collection $arrieresAnterieures;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: ArrieresPrimaire::class, orphanRemoval: true)]
    private Collection $arrieresPrimaires;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: ArrieresCollege::class, orphanRemoval: true)]
    private Collection $arrieresColleges;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Tenue::class, orphanRemoval: true)]
    private Collection $tenues;

    

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->scolariteColleges = new ArrayCollection();
        $this->scolaritePrimaires = new ArrayCollection();
        $this->arrieresAnterieures = new ArrayCollection();
        $this->arrieresPrimaires = new ArrayCollection();
        $this->arrieresColleges = new ArrayCollection();
        $this->tenues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

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
            $inscription->setAgent($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAgent() === $this) {
                $inscription->setAgent(null);
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
            $scolariteCollege->setAgent($this);
        }

        return $this;
    }

    public function removeScolariteCollege(ScolariteCollege $scolariteCollege): static
    {
        if ($this->scolariteColleges->removeElement($scolariteCollege)) {
            // set the owning side to null (unless already changed)
            if ($scolariteCollege->getAgent() === $this) {
                $scolariteCollege->setAgent(null);
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
            $scolaritePrimaire->setAgent($this);
        }

        return $this;
    }

    public function removeScolaritePrimaire(ScolaritePrimaire $scolaritePrimaire): static
    {
        if ($this->scolaritePrimaires->removeElement($scolaritePrimaire)) {
            // set the owning side to null (unless already changed)
            if ($scolaritePrimaire->getAgent() === $this) {
                $scolaritePrimaire->setAgent(null);
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
            $arrieresAnterieure->setAgent($this);
        }

        return $this;
    }

    public function removeArrieresAnterieure(ArrieresAnterieure $arrieresAnterieure): static
    {
        if ($this->arrieresAnterieures->removeElement($arrieresAnterieure)) {
            // set the owning side to null (unless already changed)
            if ($arrieresAnterieure->getAgent() === $this) {
                $arrieresAnterieure->setAgent(null);
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
            $arrieresPrimaire->setAgent($this);
        }

        return $this;
    }

    public function removeArrieresPrimaire(ArrieresPrimaire $arrieresPrimaire): static
    {
        if ($this->arrieresPrimaires->removeElement($arrieresPrimaire)) {
            // set the owning side to null (unless already changed)
            if ($arrieresPrimaire->getAgent() === $this) {
                $arrieresPrimaire->setAgent(null);
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
            $arrieresCollege->setAgent($this);
        }

        return $this;
    }

    public function removeArrieresCollege(ArrieresCollege $arrieresCollege): static
    {
        if ($this->arrieresColleges->removeElement($arrieresCollege)) {
            // set the owning side to null (unless already changed)
            if ($arrieresCollege->getAgent() === $this) {
                $arrieresCollege->setAgent(null);
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
            $tenue->setAgent($this);
        }

        return $this;
    }

    public function removeTenue(Tenue $tenue): static
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getAgent() === $this) {
                $tenue->setAgent(null);
            }
        }

        return $this;
    }

}
