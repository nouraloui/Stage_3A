<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code_cl = null;

    #[ORM\Column(length: 60)]
    private ?string $libelle_cl = null;

    #[ORM\Column(length: 300)]
    private ?string $description_cl = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cr = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_dern_modif = null;

    #[ORM\Column(length: 3)]
    private ?string $salle_principale = null;

    #[ORM\Column(length: 3)]
    private ?string $salle_secondaire_1 = null;

    #[ORM\Column(length: 3)]
    private ?string $salle_secondaire_2 = null;

    #[ORM\Column]
    private ?int $niveau_accees = null;

    #[ORM\Column(length: 2)]
    private ?string $filiere = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_scolaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCl(): ?string
    {
        return $this->code_cl;
    }

    public function setCodeCl(string $code_cl): static
    {
        $this->code_cl = $code_cl;

        return $this;
    }

    public function getLibelleCl(): ?string
    {
        return $this->libelle_cl;
    }

    public function setLibelleCl(string $libelle_cl): static
    {
        $this->libelle_cl = $libelle_cl;

        return $this;
    }

    public function getDescriptionCl(): ?string
    {
        return $this->description_cl;
    }

    public function setDescriptionCl(string $description_cl): static
    {
        $this->description_cl = $description_cl;

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

    public function getDateDernModif(): ?\DateTimeInterface
    {
        return $this->date_dern_modif;
    }

    public function setDateDernModif(\DateTimeInterface $date_dern_modif): static
    {
        $this->date_dern_modif = $date_dern_modif;

        return $this;
    }

    public function getSallePrincipale(): ?string
    {
        return $this->salle_principale;
    }

    public function setSallePrincipale(string $salle_principale): static
    {
        $this->salle_principale = $salle_principale;

        return $this;
    }

    public function getSalleSecondaire1(): ?string
    {
        return $this->salle_secondaire_1;
    }

    public function setSalleSecondaire1(string $salle_secondaire_1): static
    {
        $this->salle_secondaire_1 = $salle_secondaire_1;

        return $this;
    }

    public function getSalleSecondaire2(): ?string
    {
        return $this->salle_secondaire_2;
    }

    public function setSalleSecondaire2(string $salle_secondaire_2): static
    {
        $this->salle_secondaire_2 = $salle_secondaire_2;

        return $this;
    }

    public function getNiveauAccees(): ?int
    {
        return $this->niveau_accees;
    }

    public function setNiveauAccees(int $niveau_accees): static
    {
        $this->niveau_accees = $niveau_accees;

        return $this;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getAnneeScolaire(): ?string
    {
        return $this->annee_scolaire;
    }

    public function setAnneeScolaire(string $annee_scolaire): static
    {
        $this->annee_scolaire = $annee_scolaire;

        return $this;
    }
}
