<?php
// src/Entity/Compteur.php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteurRepository::class)]
class Compteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $code_cpt = null;

    #[ORM\Column(length: 20)]
    private ?string $lib_cpt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cr = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_last_modif = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column]
    private ?int $valeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCpt(): ?string
    {
        return $this->code_cpt;
    }

    public function setCodeCpt(string $code_cpt): static
    {
        $this->code_cpt = $code_cpt;

        return $this;
    }

    public function getLibCpt(): ?string
    {
        return $this->lib_cpt;
    }

    public function setLibCpt(string $lib_cpt): static
    {
        $this->lib_cpt = $lib_cpt;

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

    public function getDateLastModif(): ?\DateTimeInterface
    {
        return $this->date_last_modif;
    }

    public function setDateLastModif(\DateTimeInterface $date_last_modif): static
    {
        $this->date_last_modif = $date_last_modif;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }
}

/*
namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteurRepository::class)]
class Compteur
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $code_cpt = null;

    #[ORM\Column(length: 20)]
    private ?string $lib_cpt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cr = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_last_modif = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column]
    private ?int $valeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCpt(): ?string
    {
        return $this->code_cpt;
    }

    public function setCodeCpt(string $code_cpt): static
    {
        $this->code_cpt = $code_cpt;

        return $this;
    }

    public function getLibCpt(): ?string
    {
        return $this->lib_cpt;
    }

    public function setLibCpt(string $lib_cpt): static
    {
        $this->lib_cpt = $lib_cpt;

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

    public function getDateLastModif(): ?\DateTimeInterface
    {
        return $this->date_last_modif;
    }

    public function setDateLastModif(\DateTimeInterface $date_last_modif): static
    {
        $this->date_last_modif = $date_last_modif;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    
}
*/