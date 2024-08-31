<?php

namespace App\Entity;

use App\Repository\EspEnseignantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspEnseignantRepository::class)]
class EspEnseignant
{
    #[ORM\Id]
    #[ORM\Column(length: 10)]
    private ?string $id_ens = null;

    #[ORM\Column(length: 30)]
    private ?string $nom_ens = null;

    #[ORM\Column(length: 1)]
    private ?string $type_ens = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rec = null;

    #[ORM\Column(length: 2)]
    private ?string $niveau = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_saisie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_dern_modif = null;

    #[ORM\Column(length: 1)]
    private ?string $etat = null;

    #[ORM\Column(length: 300)]
    private ?string $observation = null;

    public function getIdEns(): ?string
    {
        return $this->id_ens;
    }

    public function setIdEns(string $id_ens): static
    {
        $this->id_ens = $id_ens;

        return $this;
    }

    public function getNomEns(): ?string
    {
        return $this->nom_ens;
    }

    public function setNomEns(string $nom_ens): static
    {
        $this->nom_ens = $nom_ens;

        return $this;
    }

    public function getTypeEns(): ?string
    {
        return $this->type_ens;
    }

    public function setTypeEns(string $type_ens): static
    {
        $this->type_ens = $type_ens;

        return $this;
    }

    public function getDateRec(): ?\DateTimeInterface
    {
        return $this->date_rec;
    }

    public function setDateRec(\DateTimeInterface $date_rec): static
    {
        $this->date_rec = $date_rec;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDateSaisie(): ?\DateTimeInterface
    {
        return $this->date_saisie;
    }

    public function setDateSaisie(\DateTimeInterface $date_saisie): static
    {
        $this->date_saisie = $date_saisie;

        return $this;
    }

    public function getDateDernModif(): ?\DateTimeInterface
    {
        return $this->date_dern_modif;
    }

    public function setDateDernModif(\DateTimeInterface $date_dern_modif): static
    {
        $this->date_dern_modif = $date_dern_modif;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id_ens ?? '';
    }
}
