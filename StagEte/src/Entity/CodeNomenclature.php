<?php

namespace App\Entity;

use App\Repository\CodeNomenclatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodeNomenclatureRepository::class)]
class CodeNomenclature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 3)]
    private ?string $code_nome = null;
    #[ORM\Column(length: 100)]
    private ?string $lib_nome = null;




    public function getLibNome(): ?string
    {
        return $this->lib_nome;
    }

    public function setLibNome(string $lib_nome): static
    {
        $this->lib_nome = $lib_nome;

        return $this;
    }

    public function getCodeNome(): ?string
    {
        return $this->code_nome;
    }

    public function setCodeNome(string $code_nome): static
    {
        $this->code_nome = $code_nome;

        return $this;
    }
}
