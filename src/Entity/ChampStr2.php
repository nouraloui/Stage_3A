<?php

namespace App\Entity;

use App\Repository\ChampStr2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampStr2Repository::class)]
class ChampStr2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 2)]
    private ?string $code_champ = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_champ = null;

    #[ORM\Column(length: 40)]
    private ?string $masque_champ = null;



    public function getCodeChamp(): ?string
    {
        return $this->code_champ;
    }

    public function setCodeChamp(string $code_champ): static
    {
        $this->code_champ = $code_champ;

        return $this;
    }

    public function getNomChamp(): ?string
    {
        return $this->nom_champ;
    }

    public function setNomChamp(string $nom_champ): static
    {
        $this->nom_champ = $nom_champ;

        return $this;
    }

    public function getMasqueChamp(): ?string
    {
        return $this->masque_champ;
    }

    public function setMasqueChamp(string $masque_champ): static
    {
        $this->masque_champ = $masque_champ;

        return $this;
    }
}
