<?php

namespace App\Entity;

use App\Repository\PhotosEtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotosEtudiantRepository::class)]
class PhotosEtudiant
{
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column]
     private ?int $id = null;
    

    #[ORM\Column(type: Types::BLOB)]
    private $photos_id = null;

    #[ORM\OneToOne(inversedBy: 'photo', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EspEtudiant $id_et = null;
  

    public function getPhotosId()
    {
        return $this->photos_id;
    }

    public function setPhotosId($photos_id): static
    {
        $this->photos_id = $photos_id;

        return $this;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEt(): ?EspEtudiant
    {
        return $this->id_et;
    }

    public function setIdEt(EspEtudiant $id_et): static
    {
        $this->id_et = $id_et;

        return $this;
    }

    
}
