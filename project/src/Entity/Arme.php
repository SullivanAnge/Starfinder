<?php

namespace App\Entity;

use App\Repository\ArmeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmeRepository::class)
 */
class Arme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $degats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TypeDegat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $portee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critque;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $consomation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $volume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $special;

    /**
     * @ORM\ManyToOne(targetEntity=TypeArme::class, inversedBy="armes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $main;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDegats(): ?string
    {
        return $this->degats;
    }

    public function setDegats(string $degats): self
    {
        $this->degats = $degats;

        return $this;
    }

    public function getTypeDegat(): ?string
    {
        return $this->TypeDegat;
    }

    public function setTypeDegat(string $TypeDegat): self
    {
        $this->TypeDegat = $TypeDegat;

        return $this;
    }

    public function getPortee(): ?string
    {
        return $this->portee;
    }

    public function setPortee(?string $portee): self
    {
        $this->portee = $portee;

        return $this;
    }

    public function getCritque(): ?string
    {
        return $this->critque;
    }

    public function setCritque(string $critque): self
    {
        $this->critque = $critque;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(?int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getConsomation(): ?int
    {
        return $this->consomation;
    }

    public function setConsomation(?int $consomation): self
    {
        $this->consomation = $consomation;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getspecial(): ?string
    {
        return $this->Sspecial;
    }

    public function setspecial(?string $special): self
    {
        $this->special = $special;

        return $this;
    }

    public function getType(): ?TypeArme
    {
        return $this->type;
    }

    public function setType(?TypeArme $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMain(): ?int
    {
        return $this->main;
    }

    public function setMain(?int $main): self
    {
        $this->main = $main;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
