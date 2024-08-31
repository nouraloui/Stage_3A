<?php

namespace App\Entity;

use App\Repository\EspInscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspInscriptionRepository::class)]
class EspInscription
{   
 
    #[ORM\Id]
    #[ORM\Column(length: 4)]
    private ?string $annee_deb = null;

    #[ORM\Id]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\Column(length: 10)]
    private ?string $esp_annee_deb = null;

    #[ORM\ManyToOne(inversedBy: 'espInscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compteur $code_cl = null;
    public function getCodeCl(): ?Compteur
    {
        return $this->code_cl;
    }
    public function setCodeCl(?Compteur $code_cl): static
    {
        $this->code_cl = $code_cl;

        return $this;
    }


    #[ORM\Column]
    private ?int $cout_annuel = null;

    #[ORM\Column]
    private ?int $frais_ins = null;

    #[ORM\Column(length: 2)]
    private ?string $type_rglt = null;

    #[ORM\Column(length: 2)]
    private ?string $mode_rglt = null;

    #[ORM\Column(length: 4)]
    private ?string $code_dev = null;

    #[ORM\Column]
    private ?int $cout_dev = null;

    #[ORM\Column(length: 1)]
    private ?string $sit_rglt = null;

    #[ORM\Column]
    private ?int $credit_rglt = null;

    #[ORM\Column]
    private ?int $nb_credit_module = null;

    #[ORM\Column]
    private ?int $moy_sem1 = null;

    #[ORM\Column]
    private ?int $moy_sem2 = null;

    #[ORM\Column]
    private ?int $moy_general = null;

    #[ORM\Column(length: 1)]
    private ?string $resultat = null;

    #[ORM\Column]
    private ?int $niveau_accees = null;

    #[ORM\Column(length: 1)]
    private ?string $type_insc = null;

    #[ORM\Column(length: 5)]
    private ?string $niv_langue = null;

    #[ORM\Column(length: 10)]
    private ?string $code_cl_langue = null;

    #[ORM\Column(length: 16)]
    private ?string $utilisateur = null;

    #[ORM\Column(length: 16)]
    private ?string $dern_utilisateur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_preinsc = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_insc = null;

    #[ORM\Column(length: 107)]
    private ?string $code_cl1 = null;

    #[ORM\Column(length: 10)]
    private ?string $id_et = null;

    #[ORM\ManyToOne(inversedBy: 'espInscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compteur $compteur = null;

    #[ORM\ManyToOne(inversedBy: 'espInscriptions')]
    #[ORM\JoinColumn(name :"etudiant", referencedColumnName :"id_et")]
    private ?EspEtudiant $etudiant = null;

    public function __toString(): string
    {
        return $this->annee_deb ?? '';
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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

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

    public function getCoutAnnuel(): ?int
    {
        return $this->cout_annuel;
    }

    public function setCoutAnnuel(int $cout_annuel): static
    {
        $this->cout_annuel = $cout_annuel;

        return $this;
    }

    public function getFraisIns(): ?int
    {
        return $this->frais_ins;
    }

    public function setFraisIns(int $frais_ins): static
    {
        $this->frais_ins = $frais_ins;

        return $this;
    }

    public function getTypeRglt(): ?string
    {
        return $this->type_rglt;
    }

    public function setTypeRglt(string $type_rglt): static
    {
        $this->type_rglt = $type_rglt;

        return $this;
    }

    public function getModeRglt(): ?string
    {
        return $this->mode_rglt;
    }

    public function setModeRglt(string $mode_rglt): static
    {
        $this->mode_rglt = $mode_rglt;

        return $this;
    }

    public function getCodeDev(): ?string
    {
        return $this->code_dev;
    }

    public function setCodeDev(string $code_dev): static
    {
        $this->code_dev = $code_dev;

        return $this;
    }

    public function getCoutDev(): ?int
    {
        return $this->cout_dev;
    }

    public function setCoutDev(int $cout_dev): static
    {
        $this->cout_dev = $cout_dev;

        return $this;
    }

    public function getSitRglt(): ?string
    {
        return $this->sit_rglt;
    }

    public function setSitRglt(string $sit_rglt): static
    {
        $this->sit_rglt = $sit_rglt;

        return $this;
    }

    public function getCreditRglt(): ?int
    {
        return $this->credit_rglt;
    }

    public function setCreditRglt(int $credit_rglt): static
    {
        $this->credit_rglt = $credit_rglt;

        return $this;
    }

    public function getNbCreditModule(): ?int
    {
        return $this->nb_credit_module;
    }

    public function setNbCreditModule(int $nb_credit_module): static
    {
        $this->nb_credit_module = $nb_credit_module;

        return $this;
    }

    public function getMoySem1(): ?int
    {
        return $this->moy_sem1;
    }

    public function setMoySem1(int $moy_sem1): static
    {
        $this->moy_sem1 = $moy_sem1;

        return $this;
    }

    public function getMoySem2(): ?int
    {
        return $this->moy_sem2;
    }

    public function setMoySem2(int $moy_sem2): static
    {
        $this->moy_sem2 = $moy_sem2;

        return $this;
    }

    public function getMoyGeneral(): ?int
    {
        return $this->moy_general;
    }

    public function setMoyGeneral(int $moy_general): static
    {
        $this->moy_general = $moy_general;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getNiveauAccees(): ?int
    {
        return $this->niveau_accees;
    }

    public function setNiveauAccees(int $niveau_accees): static
    {
        $this->niveau_accees = $niveau_accees;

        return $this;
    }

    public function getTypeInsc(): ?string
    {
        return $this->type_insc;
    }

    public function setTypeInsc(string $type_insc): static
    {
        $this->type_insc = $type_insc;

        return $this;
    }

    public function getNivLangue(): ?string
    {
        return $this->niv_langue;
    }

    public function setNivLangue(string $niv_langue): static
    {
        $this->niv_langue = $niv_langue;

        return $this;
    }

    public function getCodeClLangue(): ?string
    {
        return $this->code_cl_langue;
    }

    public function setCodeClLangue(string $code_cl_langue): static
    {
        $this->code_cl_langue = $code_cl_langue;

        return $this;
    }

    public function getUtilisateur(): ?string
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(string $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getDernUtilisateur(): ?string
    {
        return $this->dern_utilisateur;
    }

    public function setDernUtilisateur(string $dern_utilisateur): static
    {
        $this->dern_utilisateur = $dern_utilisateur;

        return $this;
    }

    public function getDatePreinsc(): ?\DateTimeInterface
    {
        return $this->date_preinsc;
    }

    public function setDatePreinsc(\DateTimeInterface $date_preinsc): static
    {
        $this->date_preinsc = $date_preinsc;

        return $this;
    }

    public function getDateInsc(): ?\DateTimeInterface
    {
        return $this->date_insc;
    }

    public function setDateInsc(\DateTimeInterface $date_insc): static
    {
        $this->date_insc = $date_insc;
        return $this;
    }

    public function getCodeCl1(): ?string
    {
        return $this->code_cl1;
    }

    public function setCodeCl1(string $code_cl1): static
    {
        $this->code_cl1 = $code_cl1;

        return $this;
    }

    public function getIdEt(): ?string
    {
        return $this->id_et;
    }

    public function setIdEt(string $id_et): static
    {
        $this->id_et = $id_et;

        return $this;
    }

    public function getCompteur(): ?Compteur
    {
        return $this->compteur;
    }

    public function setCompteur(?Compteur $compteur): static
    {
        $this->compteur = $compteur;

        return $this;
    }

    public function getEtudiant(): ?EspEtudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?EspEtudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
