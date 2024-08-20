<?php

namespace App\Entity;

use App\Repository\PhotosEtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotosEtudiantRepository::class)]
class PhotosEtudiant
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(length: 10)]
    // private ?string $id = null;
    #[ORM\Id]
    #[ORM\OneToOne(targetEntity: EspEtudiant::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "id_et", referencedColumnName: "id_et")]
    private ?EspEtudiant $id_et = null;

    #[ORM\Column(type: Types::BLOB)]
    private $photos_id = null;


    // #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    // private ?EspEtudiant $id_et = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function getIdEt(): ?string
    // {
    //     return $this->id_et;
    // }

    // public function setIdEt(string $id_et): static
    // {
    //     $this->id_et = $id_et;

    //     return $this;
    // }

    public function getPhotosId()
    {
        return $this->photos_id;
    }

    public function setPhotosId($photos_id): static
    {
        $this->photos_id = $photos_id;

        return $this;
    }

    // public function getIdEt(): ?EspEtudiant
    // {
    //     return $this->id_et;
    // }

    // public function setIdEt(?EspEtudiant $id_et): static
    // {
    //     $this->id_et = $id_et;

    //     return $this;
    // }

    public function getIdEt(): ?EspEtudiant
    {
        return $this->id_et;
    }

    public function setIdEt(?EspEtudiant $id_et): static
    {
        $this->id_et = $id_et;

        return $this;
    }
}
