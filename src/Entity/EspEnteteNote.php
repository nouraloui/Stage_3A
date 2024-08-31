<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\EspEnteteNoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspEnteteNoteRepository::class)]
class EspEnteteNote
{#[ORM\Id]
    #[ORM\ManyToOne(targetEntity: EspModule::class)]
    #[ORM\JoinColumn(name: 'code_module', referencedColumnName: 'code_module')]
    private ?EspModule $code_module = null;

    #[ORM\Column(length: 10)]
    private ?string $codeCl = null;

    #[ORM\Column(length: 4)]
    private ?string $AnneeDeb = null;

    #[ORM\ManyToOne(targetEntity: EspEnseignant::class)]
    #[ORM\JoinColumn(name: 'id_ens', referencedColumnName: 'id_ens')]
    private ?EspEnseignant $id_ens = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTime $DateSaisie = null;

    #[ORM\Column]
    private ?int $Semestre = null;

    // Getter and Setter methods

    public function getCodeModule(): ?EspModule
    {
        return $this->code_module;
    }

    public function setCodeModule(?EspModule $code_module): static
    {
        $this->code_module = $code_module;
        return $this;
    }

    public function getCodeCl(): ?string
    {
        return $this->codeCl;
    }

    public function setCodeCl(string $codeCl): static
    {
        $this->codeCl = $codeCl;
        return $this;
    }

    public function getAnneeDeb(): ?string
    {
        return $this->AnneeDeb;
    }

    public function setAnneeDeb(string $AnneeDeb): static
    {
        $this->AnneeDeb = $AnneeDeb;
        return $this;
    }

    public function getIdEns(): ?EspEnseignant
    {
        return $this->id_ens;
    }

    public function setIdEns(?EspEnseignant $id_ens): static
    {
        $this->id_ens = $id_ens;
        return $this;
    }

    public function getDateSaisie(): ?\DateTime
    {
        return $this->DateSaisie;
    }

    public function setDateSaisie(\DateTime $DateSaisie): static
    {
        $this->DateSaisie = $DateSaisie;
        return $this;
    }

    public function getSemestre(): ?int
    {
        return $this->Semestre;
    }

    public function setSemestre(int $Semestre): static
    {
        $this->Semestre = $Semestre;
        return $this;
    }
}
