<?php

namespace App\Entity;

use App\Repository\EspPlanEtudeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspPlanEtudeRepository::class)]
class EspPlanEtude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 10)]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $num_panier = null;

    #[ORM\Column(length: 10)]
    private ?string $code_module = null;

    #[ORM\Column(length: 10)]
    private ?string $code_cl = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_deb = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_fin = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $nb_heures = null;

    #[ORM\Column]
    private ?int $coef = null;

    #[ORM\Column]
    private ?int $num_semestre = null;

    #[ORM\Column]
    private ?int $num_periodfe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_examen = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rattrapage = null;

    #[ORM\Column]
    private ?int $nb_horaire_realises = null;

    #[ORM\Column]
    private ?int $acomptabiliser = null;

    #[ORM\Column(length: 10)]
    private ?string $esp_annee_deb = null;

    #[ORM\Column(length: 3)]
    private ?string $code_salle = null;

    #[ORM\Column(length: 10)]
    private ?string $id_ens = null;

    #[ORM\Column(length: 10)]
    private ?string $id_ens2 = null;

    #[ORM\Column]
    private ?int $nb_heures_ens = null;

    #[ORM\Column]
    private ?int $nb_heures_ens2 = null;

    public function __toString(): string
    {
        return $this->code_module ?? '';
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getCodeModule(): ?string
    {
        return $this->code_module;
    }

    public function setCodeModule(string $code_module): static
    {
        $this->code_module = $code_module;
        return $this;
    }

    public function getNumPanier(): ?string
    {
        return $this->num_panier;
    }

    public function setNumPanier(string $num_panier): static
    {
        $this->num_panier = $num_panier;
        return $this;
    }

    public function getCodeCl(): ?string
    {
        return $this->code_cl;
    }

    public function setCodeCl(string $code_cl): static
    {
        $this->code_cl = $code_cl;
        return $this;
    }

    public function getAnneeDeb(): ?string
    {
        return $this->annee_deb;
    }

    public function setAnneeDeb(string $annee_deb): static
    {
        $this->annee_deb = $annee_deb;
        return $this;
    }

    public function getAnneeFin(): ?string
    {
        return $this->annee_fin;
    }

    public function setAnneeFin(string $annee_fin): static
    {
        $this->annee_fin = $annee_fin;
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

    public function getNbHeures(): ?int
    {
        return $this->nb_heures;
    }

    public function setNbHeures(int $nb_heures): static
    {
        $this->nb_heures = $nb_heures;
        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): static
    {
        $this->coef = $coef;
        return $this;
    }

    public function getNumSemestre(): ?int
    {
        return $this->num_semestre;
    }

    public function setNumSemestre(int $num_semestre): static
    {
        $this->num_semestre = $num_semestre;
        return $this;
    }

    public function getNumPeriodfe(): ?int
    {
        return $this->num_periodfe;
    }

    public function setNumPeriodfe(int $num_periodfe): static
    {
        $this->num_periodfe = $num_periodfe;
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

    public function getDateExamen(): ?\DateTimeInterface
    {
        return $this->date_examen;
    }

    public function setDateExamen(\DateTimeInterface $date_examen): static
    {
        $this->date_examen = $date_examen;
        return $this;
    }

    public function getDateRattrapage(): ?\DateTimeInterface
    {
        return $this->date_rattrapage;
    }

    public function setDateRattrapage(\DateTimeInterface $date_rattrapage): static
    {
        $this->date_rattrapage = $date_rattrapage;
        return $this;
    }

    public function getNbHoraireRealises(): ?int
    {
        return $this->nb_horaire_realises;
    }

    public function setNbHoraireRealises(int $nb_horaire_realises): static
    {
        $this->nb_horaire_realises = $nb_horaire_realises;
        return $this;
    }

    public function getAcomptabiliser(): ?int
    {
        return $this->acomptabiliser;
    }

    public function setAcomptabiliser(int $acomptabiliser): static
    {
        $this->acomptabiliser = $acomptabiliser;
        return $this;
    }

    public function getEspAnneeDeb(): ?string
    {
        return $this->esp_annee_deb;
    }

    public function setEspAnneeDeb(string $esp_annee_deb): static
    {
        $this->esp_annee_deb = $esp_annee_deb;
        return $this;
    }

    public function getCodeSalle(): ?string
    {
        return $this->code_salle;
    }

    public function setCodeSalle(string $code_salle): static
    {
        $this->code_salle = $code_salle;
        return $this;
    }

    public function getIdEns(): ?string
    {
        return $this->id_ens;
    }

    public function setIdEns(string $id_ens): static
    {
        $this->id_ens = $id_ens;
        return $this;
    }

    public function getIdEns2(): ?string
    {
        return $this->id_ens2;
    }

    public function setIdEns2(string $id_ens2): static
    {
        $this->id_ens2 = $id_ens2;
        return $this;
    }

    public function getNbHeuresEns(): ?int
    {
        return $this->nb_heures_ens;
    }

    public function setNbHeuresEns(int $nb_heures_ens): static
    {
        $this->nb_heures_ens = $nb_heures_ens;
        return $this;
    }

    public function getNbHeuresEns2(): ?int
    {
        return $this->nb_heures_ens2;
    }

    public function setNbHeuresEns2(int $nb_heures_ens2): static
    {
        $this->nb_heures_ens2 = $nb_heures_ens2;
        return $this;
    }
}
