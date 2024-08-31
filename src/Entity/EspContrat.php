<?php

namespace App\Entity;

use App\Repository\EspContratRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspContratRepository::class)]
class EspContrat
{
    #[ORM\Id]
    #[ORM\Column(length: 10)]
    private ?string $numord = null;

    #[ORM\Column(length: 4)]
    private ?string $annee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_etab = null;

    #[ORM\Column(length: 2)]
    private ?string $diplome = null;

    #[ORM\Column(length: 2)]
    private ?string $grade = null;

    #[ORM\Column(length: 40)]
    private ?string $institution = null;

    public function getNumord(): ?string
    {
        return $this->numord;
    }

    public function setNumord(string $numord): static
    {
        $this->numord = $numord;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDateEtab(): ?\DateTimeInterface
    {
        return $this->date_etab;
    }

    public function setDateEtab(\DateTimeInterface $date_etab): static
    {
        $this->date_etab = $date_etab;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): static
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): static
    {
        $this->institution = $institution;

        return $this;
    }
}
