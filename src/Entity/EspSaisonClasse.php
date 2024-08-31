<?php

namespace App\Entity;

use App\Repository\EspSaisonClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspSaisonClasseRepository::class)]
class EspSaisonClasse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_demarrage = null;

    #[ORM\Column(length: 300)]
    private ?string $description = null;

    #[ORM\Column(length: 10)]
    private ?string $code_cl = null;

    #[ORM\Column]
    private ?int $nb_etudiant = null;

    #[ORM\Column(length: 2)]
    private ?string $salle_principale = null;

    #[ORM\Column(length: 3)]
    private ?string $salle_secondaire_1 = null;

    #[ORM\Column(length: 3)]
    private ?string $salle_secondaire_2 = null;

    #[ORM\Column(length: 1)]
    private ?string $nature = null;

    #[ORM\Column(length: 2)]
    private ?string $type_classe = null;

    #[ORM\Column]
    private ?int $nb_seance = null;

    #[ORM\Column(length: 1)]
    private ?string $classe_entreprise = null;

    #[ORM\Column]
    private ?int $semestre = null;

    #[ORM\Column(length: 1)]
    private ?string $cl_eclate = null;

    #[ORM\Column(length: 10)]
    private ?string $annee_deb = null;

    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'Saison', orphanRemoval: true)]
    private Collection $Classes;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    private ?EspSaisonUniversitaire $espSaisonUniversitaire = null;

    public function __construct()
    {
        $this->Classes = new ArrayCollection();
    }

   

    

    public function getCodeCl(): ?string
    {
        return $this->code_cl;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setCodeCl(string $code_cl): static
    {
        $this->code_cl = $code_cl;

        return $this;
    }

    public function getDateDemarrage(): ?\DateTimeInterface
    {
        return $this->date_demarrage;
    }

    public function setDateDemarrage(\DateTimeInterface $date_demarrage): static
    {
        $this->date_demarrage = $date_demarrage;

        return $this;
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

    public function getNbEtudiant(): ?int
    {
        return $this->nb_etudiant;
    }

    public function setNbEtudiant(int $nb_etudiant): static
    {
        $this->nb_etudiant = $nb_etudiant;

        return $this;
    }

    public function getSallePrincipale(): ?string
    {
        return $this->salle_principale;
    }

    public function setSallePrincipale(string $salle_principale): static
    {
        $this->salle_principale = $salle_principale;

        return $this;
    }

    public function getSalleSecondaire1(): ?string
    {
        return $this->salle_secondaire_1;
    }

    public function setSalleSecondaire1(string $salle_secondaire_1): static
    {
        $this->salle_secondaire_1 = $salle_secondaire_1;

        return $this;
    }

    public function getSalleSecondaire2(): ?string
    {
        return $this->salle_secondaire_2;
    }

    public function setSalleSecondaire2(string $salle_secondaire_2): static
    {
        $this->salle_secondaire_2 = $salle_secondaire_2;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

        return $this;
    }

    public function getTypeClasse(): ?string
    {
        return $this->type_classe;
    }

    public function setTypeClasse(string $type_classe): static
    {
        $this->type_classe = $type_classe;

        return $this;
    }

    public function getNbSeance(): ?int
    {
        return $this->nb_seance;
    }

    public function setNbSeance(int $nb_seance): static
    {
        $this->nb_seance = $nb_seance;

        return $this;
    }

    public function getClasseEntreprise(): ?string
    {
        return $this->classe_entreprise;
    }

    public function setClasseEntreprise(string $classe_entreprise): static
    {
        $this->classe_entreprise = $classe_entreprise;

        return $this;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(int $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getClEclate(): ?string
    {
        return $this->cl_eclate;
    }

    public function setClEclate(string $cl_eclate): static
    {
        $this->cl_eclate = $cl_eclate;

        return $this;
    }

   

    public function getAnneeDeb(): ?string
    {
        return $this->annee_deb;
    }

    public function setAnneeDeb(?string $annee_deb): static
    {
        $this->annee_deb = $annee_deb;

        return $this;
    }

  

  

    public function __toString(): string
    {
        return $this->annee_deb ?? '';
    }


    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->Classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->Classes->contains($class)) {
            $this->Classes->add($class);
            $class->setSaison($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->Classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getSaison() === $this) {
                $class->setSaison(null);
            }
        }

        return $this;
    }

    public function getEspSaisonUniversitaire(): ?EspSaisonUniversitaire
    {
        return $this->espSaisonUniversitaire;
    }

    public function setEspSaisonUniversitaire(?EspSaisonUniversitaire $espSaisonUniversitaire): static
    {
        $this->espSaisonUniversitaire = $espSaisonUniversitaire;

        return $this;
    }
}
