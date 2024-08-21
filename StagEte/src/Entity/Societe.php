<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 2)]
    private ?string $code_soc = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_soc = null;

    #[ORM\Column(length: 40)]
    private ?string $adr_soc = null;

    #[ORM\Column(length: 20)]
    private ?string $tel_soc = null;

    #[ORM\Column(length: 20)]
    private ?string $fax_soc = null;

    #[ORM\Column(type: Types::BINARY)]
    private $sigle = null;

    #[ORM\Column(length: 50)]
    private ?string $e_mail = null;

    #[ORM\Column(length: 4)]
    private ?string $code_postal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cr = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_maj = null;

    #[ORM\Column(length: 40)]
    private ?string $ville = null;

    #[ORM\Column(length: 25)]
    private ?string $rib = null;

    #[ORM\Column(length: 15)]
    private ?string $code_tva = null;

    #[ORM\Column(length: 20)]
    private ?string $banque = null;

    #[ORM\Column(length: 15)]
    private ?string $rc = null;

    #[ORM\Column(length: 3)]
    private ?string $code_rglt_comptant = null;

    #[ORM\Column(length: 3)]
    private ?string $code_rglt_espece = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_deb = null;

    #[ORM\Column(length: 4)]
    private ?string $annee_fin = null;

    #[ORM\Column]
    private ?int $taux_exam = null;

    #[ORM\Column]
    private ?int $taux_ds = null;

    #[ORM\Column]
    private ?int $taux_tp = null;


    public function getCodeSoc(): ?string
    {
        return $this->code_soc;
    }

    public function setCodeSoc(string $code_soc): static
    {
        $this->code_soc = $code_soc;

        return $this;
    }

    public function getNomSoc(): ?string
    {
        return $this->nom_soc;
    }

    public function setNomSoc(string $nom_soc): static
    {
        $this->nom_soc = $nom_soc;

        return $this;
    }

    public function getAdrSoc(): ?string
    {
        return $this->adr_soc;
    }

    public function setAdrSoc(string $adr_soc): static
    {
        $this->adr_soc = $adr_soc;

        return $this;
    }

    public function getTelSoc(): ?string
    {
        return $this->tel_soc;
    }

    public function setTelSoc(string $tel_soc): static
    {
        $this->tel_soc = $tel_soc;

        return $this;
    }

    public function getFaxSoc(): ?string
    {
        return $this->fax_soc;
    }

    public function setFaxSoc(string $fax_soc): static
    {
        $this->fax_soc = $fax_soc;

        return $this;
    }

    public function getSigle()
    {
        return $this->sigle;
    }

    public function setSigle($sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->e_mail;
    }

    public function setEMail(string $e_mail): static
    {
        $this->e_mail = $e_mail;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

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

    public function getDateMaj(): ?\DateTimeInterface
    {
        return $this->date_maj;
    }

    public function setDateMaj(\DateTimeInterface $date_maj): static
    {
        $this->date_maj = $date_maj;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(string $rib): static
    {
        $this->rib = $rib;

        return $this;
    }

    public function getCodeTva(): ?string
    {
        return $this->code_tva;
    }

    public function setCodeTva(string $code_tva): static
    {
        $this->code_tva = $code_tva;

        return $this;
    }

    public function getBanque(): ?string
    {
        return $this->banque;
    }

    public function setBanque(string $banque): static
    {
        $this->banque = $banque;

        return $this;
    }

    public function getRC(): ?string
    {
        return $this->rc;
    }

    public function setRC(string $rc): static
    {
        $this->rc = $rc;

        return $this;
    }

    public function getCodeRgltComptant(): ?string
    {
        return $this->code_rglt_comptant;
    }

    public function setCodeRgltComptant(string $code_rglt_comptant): static
    {
        $this->code_rglt_comptant = $code_rglt_comptant;

        return $this;
    }

    public function getCodeRgltEspece(): ?string
    {
        return $this->code_rglt_espece;
    }

    public function setCodeRgltEspece(string $code_rglt_espece): static
    {
        $this->code_rglt_espece = $code_rglt_espece;

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

    public function getTauxExam(): ?int
    {
        return $this->taux_exam;
    }

    public function setTauxExam(int $taux_exam): static
    {
        $this->taux_exam = $taux_exam;

        return $this;
    }

    public function getTauxDs(): ?int
    {
        return $this->taux_ds;
    }

    public function setTauxDs(int $taux_ds): static
    {
        $this->taux_ds = $taux_ds;

        return $this;
    }

    public function getTauxTp(): ?int
    {
        return $this->taux_tp;
    }

    public function setTauxTp(int $taux_tp): static
    {
        $this->taux_tp = $taux_tp;

        return $this;
    }
}
