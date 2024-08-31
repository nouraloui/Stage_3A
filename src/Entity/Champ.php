<?php

namespace App\Entity;

use App\Repository\ChampRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampRepository::class)]
class Champ
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $cha_code_str = null;

    #[ORM\Column(length: 100)]
    private ?string $valeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChaCodeStr(): ?string
    {
        return $this->cha_code_str;
    }

    public function setChaCodeStr(string $cha_code_str): static
    {
        $this->cha_code_str = $cha_code_str;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }
}
