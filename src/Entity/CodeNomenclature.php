<?php

namespace App\Entity;

use App\Repository\CodeNomenclatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodeNomenclatureRepository::class)]
class CodeNomenclature
{
    #[ORM\Id]
    #[ORM\Column(length: 3)]
    private ?string $code_nome = null;

    #[ORM\Column(length: 100)]
    private ?string $lib_nome = null;

    #[ORM\ManyToOne(targetEntity: StrNome::class, fetch: 'LAZY', cascade: ['persist'])]
    #[ORM\JoinColumn(name: "code_str", referencedColumnName: "code_str", nullable: true, onDelete: "CASCADE")]
    private ?StrNome $code_str = null;

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

    public function getCodeStr(): ?StrNome
    {
        return $this->code_str;
    }

    public function setCodeStr(?StrNome $code_str): static
    {
        $this->code_str = $code_str;

        return $this;
    }

    public function __toString()
    {
        return $this->getCodeNome() . ' - ' . $this->getLibNome();
    }
}
