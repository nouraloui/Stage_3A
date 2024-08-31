<?php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteurRepository::class)]
class Compteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $code_cpt = null;

    #[ORM\Column(length: 20)]
    private ?string $lib_cpt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cr = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_last_modif = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column]
    private ?int $valeur = null;

    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'code_cl', orphanRemoval: true)]
    private Collection $classes;

    #[ORM\OneToMany(targetEntity: EspInscription::class, mappedBy: 'code_cl', orphanRemoval: true)]
    private Collection $espInscriptions;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->espInscriptions = new ArrayCollection();
    }
    public function __toString(): string
    {
        return ($this->code_cpt ?? '') .' ';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCpt(): ?string
    {
        return $this->code_cpt;
    }

    public function setCodeCpt(string $code_cpt): static
    {
        $this->code_cpt = $code_cpt;

        return $this;
    }

    public function getLibCpt(): ?string
    {
        return $this->lib_cpt;
    }

    public function setLibCpt(string $lib_cpt): static
    {
        $this->lib_cpt = $lib_cpt;

        return $this;
    }

    public function getDateCr(): ?\DateTimeInterface
    {
        return $this->date_cr;
    }

    public function setDateCr(\DateTimeInterface $date_cr): static
    {
        $this->date_cr = $date_cr;

        return $this;
    }

    public function getDateLastModif(): ?\DateTimeInterface
    {
        return $this->date_last_modif;
    }

    public function setDateLastModif(\DateTimeInterface $date_last_modif): static
    {
        $this->date_last_modif = $date_last_modif;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setCodeCl($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getCodeCl() === $this) {
                $class->setCodeCl(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EspInscription>
     */
    public function getEspInscriptions(): Collection
    {
        return $this->espInscriptions;
    }

    public function addEspInscription(EspInscription $espInscription): static
    {
        if (!$this->espInscriptions->contains($espInscription)) {
            $this->espInscriptions->add($espInscription);
            $espInscription->setCodeCl($this);
        }

        return $this;
    }

    public function removeEspInscription(EspInscription $espInscription): static
    {
        if ($this->espInscriptions->removeElement($espInscription)) {
            // set the owning side to null (unless already changed)
            if ($espInscription->getCodeCl() === $this) {
                $espInscription->setCodeCl(null);
            }
        }

        return $this;
    }
}
