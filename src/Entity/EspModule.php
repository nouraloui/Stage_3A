<?php

namespace App\Entity;

use App\Repository\EspModuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspModuleRepository::class)]
class EspModule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 10)]
    private ?string $code_module = null;

    #[ORM\Column(length: 50)]
    private ?string $designation = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $nb_heures = null;

    public function getCodeModule(): ?string
    {
        return $this->code_module;
    }

    public function setCodeModule(string $code_module): static
    {
        $this->code_module = $code_module;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbHeures(): ?int
    {
        return $this->nb_heures;
    }

    public function setNbHeures(int $nb_heures): static
    {
        $this->nb_heures = $nb_heures;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->code_module; // Adjust as needed
    }
}
