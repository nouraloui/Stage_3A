<?php

namespace App\Entity;

use App\Repository\EspEtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspEtudiantRepository::class)]
class EspEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom_et = null;

    #[ORM\Column(length: 30)]
    private ?string $pnom_et = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_nais_et = null;

    #[ORM\Column(length: 30)]
    private ?string $lieu_nais_et = null;

    public function __toString(): string
    {
        return $this->id ?? '';
    }

    #[ORM\Column(length: 2)]
    private ?string $nature_et = null;

    #[ORM\Column(length: 30)]
    private ?string $fonction_et = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_et = null;

    #[ORM\Column(length: 120)]
    private ?string $tel_et = null;

    #[ORM\Column(length: 30)]
    private ?string $tel_parent_et = null;

    #[ORM\Column(length: 60)]
    private ?string $e_mail_et = null;

    #[ORM\Column(length: 2)]
    private ?string $cycle_et = null;

    #[ORM\Column(length: 2)]
    private ?string $nature_bac = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_bac = null;

    #[ORM\Column(length: 20)]
    private ?string $num_bac_et = null;

    #[ORM\Column(length: 100)]
    private ?string $etab_bac = null;

    #[ORM\Column(length: 100)]
    private ?string $diplome_sup_et = null;

    #[ORM\Column]
    private ?int $niveau_diplome_sup_et = null;

    #[ORM\Column(length: 100)]
    private ?string $etab_origine = null;

    #[ORM\Column(length: 2)]
    private ?string $speialite_esp_et = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_entree_esp_et = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_entree_esp_et = null;

    #[ORM\Column(length: 10)]
    private ?string $classe_courante_et = null;

    #[ORM\Column(length: 2)]
    private ?string $situation_financiere_et = null;

    #[ORM\Column]
    private ?int $niveau_courant_et = null;

    #[ORM\Column]
    private ?int $moyenne_dern_semestre_et = null;

    #[ORM\Column(length: 2)]
    private ?string $resultat_final_et = null;

    #[ORM\Column(length: 2)]
    private ?string $diplome_obtenu_esp_et = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie_et = null;

    #[ORM\Column(length: 1000)]
    private ?string $observation_et = null;

    #[ORM\Column(type: Types::BINARY)]
    private $photo_et = null;

    #[ORM\Column(length: 1)]
    private ?string $sexe = null;

    #[ORM\Column(length: 20)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 30)]
    private ?string $num_cin_passeport = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_saisie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_dern_modif = null;

    #[ORM\Column(length: 10)]
    private ?string $agent = null;

    #[ORM\Column(length: 10)]
    private ?string $num_ord = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_delivrance = null;

    #[ORM\Column(length: 30)]
    private ?string $lieu_delivrance = null;

    #[ORM\Column]
    private ?int $niveau_acces = null;

    #[ORM\Column(length: 2)]
    private ?string $nature_cours = null;

    #[ORM\Column]
    private ?int $nature_piece_id = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_parent = null;

    #[ORM\Column(length: 6)]
    private ?string $cp_parent = null;

    #[ORM\Column(length: 30)]
    private ?string $ville_parent = null;

    #[ORM\Column(length: 30)]
    private ?string $pays_parent = null;

    #[ORM\Column(length: 6)]
    private ?string $cp_et = null;

    #[ORM\Column(length: 255)]
    private ?string $ville_et = null;

    #[ORM\Column(length: 30)]
    private ?string $pays_et = null;

    #[ORM\Column(length: 60)]
    private ?string $e_mail_parent = null;

    #[ORM\Column]
    private ?bool $inscription = null;

    #[ORM\Column]
    private ?bool $affecte = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Classe $classe = null;

    #[ORM\OneToMany(targetEntity: EspInscription::class, mappedBy: 'etudiant', orphanRemoval: true)]
    private Collection $espInscriptions;

    #[ORM\OneToOne(mappedBy: 'id_et', cascade: ['persist', 'remove'])]
    private ?PhotosEtudiant $photo = null;

    public function __construct()
    {
        $this->espInscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEt(): ?string
    {
        return $this->nom_et;
    }

    public function setNomEt(string $nom_et): static
    {
        $this->nom_et = $nom_et;

        return $this;
    }

    public function getPnomEt(): ?string
    {
        return $this->pnom_et;
    }

    public function setPnomEt(string $pnom_et): static
    {
        $this->pnom_et = $pnom_et;

        return $this;
    }

    public function getDateNaisEt(): ?\DateTimeInterface
    {
        return $this->date_nais_et;
    }

    public function setDateNaisEt(\DateTimeInterface $date_nais_et): static
    {
        $this->date_nais_et = $date_nais_et;

        return $this;
    }

    public function getLieuNaisEt(): ?string
    {
        return $this->lieu_nais_et;
    }

    public function setLieuNaisEt(string $lieu_nais_et): static
    {
        $this->lieu_nais_et = $lieu_nais_et;

        return $this;
    }

    public function getNatureEt(): ?string
    {
        return $this->nature_et;
    }

    public function setNatureEt(string $nature_et): static
    {
        $this->nature_et = $nature_et;

        return $this;
    }

    public function getFonctionEt(): ?string
    {
        return $this->fonction_et;
    }

    public function setFonctionEt(string $fonction_et): static
    {
        $this->fonction_et = $fonction_et;

        return $this;
    }

    public function getAdresseEt(): ?string
    {
        return $this->adresse_et;
    }

    public function setAdresseEt(string $adresse_et): static
    {
        $this->adresse_et = $adresse_et;

        return $this;
    }

    public function getTelEt(): ?string
    {
        return $this->tel_et;
    }

    public function setTelEt(string $tel_et): static
    {
        $this->tel_et = $tel_et;

        return $this;
    }

    public function getTelParentEt(): ?string
    {
        return $this->tel_parent_et;
    }

    public function setTelParentEt(string $tel_parent_et): static
    {
        $this->tel_parent_et = $tel_parent_et;

        return $this;
    }

    public function getEMailEt(): ?string
    {
        return $this->e_mail_et;
    }

    public function setEMailEt(string $e_mail_et): static
    {
        $this->e_mail_et = $e_mail_et;

        return $this;
    }

    public function getCycleEt(): ?string
    {
        return $this->cycle_et;
    }

    public function setCycleEt(string $cycle_et): static
    {
        $this->cycle_et = $cycle_et;

        return $this;
    }

    public function getNatureBac(): ?string
    {
        return $this->nature_bac;
    }

    public function setNatureBac(string $nature_bac): static
    {
        $this->nature_bac = $nature_bac;

        return $this;
    }

    public function getDateBac(): ?\DateTimeInterface
    {
        return $this->date_bac;
    }

    public function setDateBac(\DateTimeInterface $date_bac): static
    {
        $this->date_bac = $date_bac;

        return $this;
    }

    public function getNumBacEt(): ?string
    {
        return $this->num_bac_et;
    }

    public function setNumBacEt(string $num_bac_et): static
    {
        $this->num_bac_et = $num_bac_et;

        return $this;
    }

    public function getEtabBac(): ?string
    {
        return $this->etab_bac;
    }

    public function setEtabBac(string $etab_bac): static
    {
        $this->etab_bac = $etab_bac;

        return $this;
    }

    public function getDiplomeSupEt(): ?string
    {
        return $this->diplome_sup_et;
    }

    public function setDiplomeSupEt(string $diplome_sup_et): static
    {
        $this->diplome_sup_et = $diplome_sup_et;

        return $this;
    }

    public function getNiveauDiplomeSupEt(): ?int
    {
        return $this->niveau_diplome_sup_et;
    }

    public function setNiveauDiplomeSupEt(int $niveau_diplome_sup_et): static
    {
        $this->niveau_diplome_sup_et = $niveau_diplome_sup_et;

        return $this;
    }

    public function getEtabOrigine(): ?string
    {
        return $this->etab_origine;
    }

    public function setEtabOrigine(string $etab_origine): static
    {
        $this->etab_origine = $etab_origine;

        return $this;
    }

    public function getSpeialiteEspEt(): ?string
    {
        return $this->speialite_esp_et;
    }

    public function setSpeialiteEspEt(string $speialite_esp_et): static
    {
        $this->speialite_esp_et = $speialite_esp_et;

        return $this;
    }

    public function getDateEntreeEspEt(): ?\DateTimeInterface
    {
        return $this->date_entree_esp_et;
    }

    public function setDateEntreeEspEt(\DateTimeInterface $date_entree_esp_et): static
    {
        $this->date_entree_esp_et = $date_entree_esp_et;

        return $this;
    }

    public function getAnneeEntreeEspEt(): ?string
    {
        return $this->annee_entree_esp_et;
    }

    public function setAnneeEntreeEspEt(string $annee_entree_esp_et): static
    {
        $this->annee_entree_esp_et = $annee_entree_esp_et;

        return $this;
    }

    public function getClasseCouranteEt(): ?string
    {
        return $this->classe_courante_et;
    }

    public function setClasseCouranteEt(string $classe_courante_et): static
    {
        $this->classe_courante_et = $classe_courante_et;

        return $this;
    }

    public function getSituationFinanciereEt(): ?string
    {
        return $this->situation_financiere_et;
    }

    public function setSituationFinanciereEt(string $situation_financiere_et): static
    {
        $this->situation_financiere_et = $situation_financiere_et;

        return $this;
    }

    public function getNiveauCourantEt(): ?int
    {
        return $this->niveau_courant_et;
    }

    public function setNiveauCourantEt(int $niveau_courant_et): static
    {
        $this->niveau_courant_et = $niveau_courant_et;

        return $this;
    }

    public function getMoyenneDernSemestreEt(): ?int
    {
        return $this->moyenne_dern_semestre_et;
    }

    public function setMoyenneDernSemestreEt(int $moyenne_dern_semestre_et): static
    {
        $this->moyenne_dern_semestre_et = $moyenne_dern_semestre_et;

        return $this;
    }

    public function getResultatFinalEt(): ?string
    {
        return $this->resultat_final_et;
    }

    public function setResultatFinalEt(string $resultat_final_et): static
    {
        $this->resultat_final_et = $resultat_final_et;

        return $this;
    }

    public function getDiplomeObtenuEspEt(): ?string
    {
        return $this->diplome_obtenu_esp_et;
    }

    public function setDiplomeObtenuEspEt(string $diplome_obtenu_esp_et): static
    {
        $this->diplome_obtenu_esp_et = $diplome_obtenu_esp_et;

        return $this;
    }

    public function getDateSortieEt(): ?\DateTimeInterface
    {
        return $this->date_sortie_et;
    }

    public function setDateSortieEt(\DateTimeInterface $date_sortie_et): static
    {
        $this->date_sortie_et = $date_sortie_et;

        return $this;
    }

    public function getObservationEt(): ?string
    {
        return $this->observation_et;
    }

    public function setObservationEt(string $observation_et): static
    {
        $this->observation_et = $observation_et;

        return $this;
    }

    public function getPhotoEt()
    {
        return $this->photo_et;
    }

    public function setPhotoEt($photo_et): static
    {
        $this->photo_et = $photo_et;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNumCinPasseport(): ?string
    {
        return $this->num_cin_passeport;
    }

    public function setNumCinPasseport(string $num_cin_passeport): static
    {
        $this->num_cin_passeport = $num_cin_passeport;

        return $this;
    }

    public function getDateSaisie(): ?\DateTimeInterface
    {
        return $this->date_saisie;
    }

    public function setDateSaisie(\DateTimeInterface $date_saisie): static
    {
        $this->date_saisie = $date_saisie;

        return $this;
    }

    public function getDateDernModif(): ?\DateTimeInterface
    {
        return $this->date_dern_modif;
    }

    public function setDateDernModif(\DateTimeInterface $date_dern_modif): static
    {
        $this->date_dern_modif = $date_dern_modif;

        return $this;
    }

    public function getAgent(): ?string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getNumOrd(): ?string
    {
        return $this->num_ord;
    }

    public function setNumOrd(string $num_ord): static
    {
        $this->num_ord = $num_ord;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->date_delivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $date_delivrance): static
    {
        $this->date_delivrance = $date_delivrance;

        return $this;
    }

    public function getLieuDelivrance(): ?string
    {
        return $this->lieu_delivrance;
    }

    public function setLieuDelivrance(string $lieu_delivrance): static
    {
        $this->lieu_delivrance = $lieu_delivrance;

        return $this;
    }

    public function getNiveauAcces(): ?int
    {
        return $this->niveau_acces;
    }

    public function setNiveauAcces(int $niveau_acces): static
    {
        $this->niveau_acces = $niveau_acces;

        return $this;
    }

    public function getNatureCours(): ?string
    {
        return $this->nature_cours;
    }

    public function setNatureCours(string $nature_cours): static
    {
        $this->nature_cours = $nature_cours;

        return $this;
    }

    public function getNaturePieceId(): ?int
    {
        return $this->nature_piece_id;
    }

    public function setNaturePieceId(int $nature_piece_id): static
    {
        $this->nature_piece_id = $nature_piece_id;

        return $this;
    }

    public function getAdresseParent(): ?string
    {
        return $this->adresse_parent;
    }

    public function setAdresseParent(string $adresse_parent): static
    {
        $this->adresse_parent = $adresse_parent;

        return $this;
    }

    public function getCpParent(): ?string
    {
        return $this->cp_parent;
    }

    public function setCpParent(string $cp_parent): static
    {
        $this->cp_parent = $cp_parent;

        return $this;
    }

    public function getVilleParent(): ?string
    {
        return $this->ville_parent;
    }

    public function setVilleParent(string $ville_parent): static
    {
        $this->ville_parent = $ville_parent;

        return $this;
    }

    public function getPaysParent(): ?string
    {
        return $this->pays_parent;
    }

    public function setPaysParent(string $pays_parent): static
    {
        $this->pays_parent = $pays_parent;

        return $this;
    }

    public function getCpEt(): ?string
    {
        return $this->cp_et;
    }

    public function setCpEt(string $cp_et): static
    {
        $this->cp_et = $cp_et;

        return $this;
    }

    public function getVilleEt(): ?string
    {
        return $this->ville_et;
    }

    public function setVilleEt(string $ville_et): static
    {
        $this->ville_et = $ville_et;

        return $this;
    }

    public function getPaysEt(): ?string
    {
        return $this->pays_et;
    }

    public function setPaysEt(string $pays_et): static
    {
        $this->pays_et = $pays_et;

        return $this;
    }

    public function getEMailParent(): ?string
    {
        return $this->e_mail_parent;
    }

    public function setEMailParent(string $e_mail_parent): static
    {
        $this->e_mail_parent = $e_mail_parent;

        return $this;
    }

    public function isInscription(): ?bool
    {
        return $this->inscription;
    }

    public function setInscription(bool $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function isAffecte(): ?bool
    {
        return $this->affecte;
    }

    public function setAffecte(bool $affecte): static
    {
        $this->affecte = $affecte;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, EspInscription>
     */
    public function getEspInscriptions(): Collection
    {
        return $this->espInscriptions;
    }

    public function addEspInscription(EspInscription $espInscription): static
    {
        if (!$this->espInscriptions->contains($espInscription)) {
            $this->espInscriptions->add($espInscription);
            $espInscription->setEtudiant($this);
        }

        return $this;
    }

    public function removeEspInscription(EspInscription $espInscription): static
    {
        if ($this->espInscriptions->removeElement($espInscription)) {
            // set the owning side to null (unless already changed)
            if ($espInscription->getEtudiant() === $this) {
                $espInscription->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?PhotosEtudiant
    {
        return $this->photo;
    }

    public function setPhoto(PhotosEtudiant $photo): static
    {
        // set the owning side of the relation if necessary
        if ($photo->getIdEt() !== $this) {
            $photo->setIdEt($this);
        }

        $this->photo = $photo;

        return $this;
    }
}
