<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    // #[ORM\Column]
    // private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $m_sgid = null;

    #[ORM\Column(length: 255)]
    private ?string $m_sgtitle = null;

    #[ORM\Column(length: 255)]
    private ?string $m_sgtext = null;

    #[ORM\Column(length: 12)]
    private ?string $m_sgicon = null;

    #[ORM\Column(length: 17)]
    private ?string $m_sgbutton = null;

    #[ORM\Column]
    private ?float $m_sgdefaultbutton = null;

    #[ORM\Column]
    private ?float $m_sgseverity = null;

    #[ORM\Column(length: 1)]
    private ?string $m_sgprint = null;

    #[ORM\Column(length: 1)]
    private ?string $m_sguserinput = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getMSgid(): ?string
    {
        return $this->m_sgid;
    }

    public function setMSgid(string $m_sgid): static
    {
        $this->m_sgid = $m_sgid;

        return $this;
    }

    public function getMSgtitle(): ?string
    {
        return $this->m_sgtitle;
    }

    public function setMSgtitle(string $m_sgtitle): static
    {
        $this->m_sgtitle = $m_sgtitle;

        return $this;
    }

    public function getMSgtext(): ?string
    {
        return $this->m_sgtext;
    }

    public function setMSgtext(string $m_sgtext): static
    {
        $this->m_sgtext = $m_sgtext;

        return $this;
    }

    public function getMSgicon(): ?string
    {
        return $this->m_sgicon;
    }

    public function setMSgicon(string $m_sgicon): static
    {
        $this->m_sgicon = $m_sgicon;

        return $this;
    }

    public function getMSgbutton(): ?string
    {
        return $this->m_sgbutton;
    }

    public function setMSgbutton(string $m_sgbutton): static
    {
        $this->m_sgbutton = $m_sgbutton;

        return $this;
    }

    public function getMSgdefaultbutton(): ?float
    {
        return $this->m_sgdefaultbutton;
    }

    public function setMSgdefaultbutton(float $m_sgdefaultbutton): static
    {
        $this->m_sgdefaultbutton = $m_sgdefaultbutton;

        return $this;
    }

    public function getMSgseverity(): ?float
    {
        return $this->m_sgseverity;
    }

    public function setMSgseverity(float $m_sgseverity): static
    {
        $this->m_sgseverity = $m_sgseverity;

        return $this;
    }

    public function getMSgprint(): ?string
    {
        return $this->m_sgprint;
    }

    public function setMSgprint(string $m_sgprint): static
    {
        $this->m_sgprint = $m_sgprint;

        return $this;
    }

    public function getMSguserinput(): ?string
    {
        return $this->m_sguserinput;
    }

    public function setMSguserinput(string $m_sguserinput): static
    {
        $this->m_sguserinput = $m_sguserinput;

        return $this;
    }
}
