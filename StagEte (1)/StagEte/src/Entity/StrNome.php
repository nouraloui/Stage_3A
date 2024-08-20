<?php

namespace App\Entity;

use App\Repository\StrNomeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StrNomeRepository::class)]
class StrNome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 2)]
    private ?string $code_str = null;

    #[ORM\Column(length: 35)]
    private ?string $nom_str = null;

 
    public function getCodeStr(): ?string
    {
        return $this->code_str;
    }

    public function setCodeStr(string $code_str): static
    {
        $this->code_str = $code_str;

        return $this;
    }

    public function getNomStr(): ?string
    {
        return $this->nom_str;
    }

    public function setNomStr(string $nom_str): static
    {
        $this->nom_str = $nom_str;

        return $this;
    }
}
