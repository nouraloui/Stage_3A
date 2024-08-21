<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 3)]
    private ?string $code_salle = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;


    public function getCodeSalle(): ?string
    {
        return $this->code_salle;
    }

    public function setCodeSalle(string $code_salle): static
    {
        $this->code_salle = $code_salle;

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
}
