<?php

namespace App\Entity;

use App\Repository\EspNoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspNoteRepository::class)]
class EspNote
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: EspModule::class)]
    #[ORM\JoinColumn(name: 'code_module', referencedColumnName: 'code_module')]
    private ?EspModule $code_module = null;

    #[ORM\Column(length: 10)]
    private ?string $codeCl = null;

    #[ORM\Column(length: 4)]
    private ?string $AnneeDeb = null;

    #[ORM\Column(length: 10)]
    private ?string $IdEt = null;

    #[ORM\Column(nullable: true)]
    private ?int $NoteExam = null;

    #[ORM\Column(nullable: true)]
    private ?int $NoteTP = null;

    #[ORM\Column(nullable: true)]
    private ?int $NoteCC = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isConfirmed = false;

    // Getters and Setters

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

    public function getIdEt(): ?string
    {
        return $this->IdEt;
    }

    public function setIdEt(string $IdEt): static
    {
        $this->IdEt = $IdEt;
        return $this;
    }

    public function getNoteExam(): ?int
    {
        return $this->NoteExam;
    }

    public function setNoteExam(?int $NoteExam): static
    {
        $this->NoteExam = $NoteExam;
        return $this;
    }

    public function getNoteTP(): ?int
    {
        return $this->NoteTP;
    }

    public function setNoteTP(?int $NoteTP): static
    {
        $this->NoteTP = $NoteTP;
        return $this;
    }

    public function getNoteCC(): ?int
    {
        return $this->NoteCC;
    }

    public function setNoteCC(?int $NoteCC): static
    {
        $this->NoteCC = $NoteCC;
        return $this;
    }

    public function getisConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): static
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }
}
