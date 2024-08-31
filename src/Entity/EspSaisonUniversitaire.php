<?php

namespace App\Entity;

use App\Repository\EspSaisonUniversitaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspSaisonUniversitaireRepository::class)]
class EspSaisonUniversitaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    public function __toString(): string
    {
        return $this->description ?? '';
    }

    #[ORM\Column(length: 500)]
    private ?string $observation = null;

    #[ORM\OneToMany(targetEntity: EspSaisonClasse::class, mappedBy: 'espSaisonUniversitaire')]
    private Collection $saisons;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return Collection<int, EspSaisonClasse>
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(EspSaisonClasse $saison): static
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons->add($saison);
            $saison->setEspSaisonUniversitaire($this);
        }

        return $this;
    }

    public function removeSaison(EspSaisonClasse $saison): static
    {
        if ($this->saisons->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getEspSaisonUniversitaire() === $this) {
                $saison->setEspSaisonUniversitaire(null);
            }
        }

        return $this;
    }

   

 
}
