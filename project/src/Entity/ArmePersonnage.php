<?php

namespace App\Entity;

use App\Repository\ArmePersonnageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmePersonnageRepository::class)
 */
class ArmePersonnage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnage::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnage;

    /**
     * @ORM\ManyToOne(targetEntity=Arme::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $arme;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }

    public function getArme(): ?Arme
    {
        return $this->arme;
    }

    public function setArme(?Arme $arme): self
    {
        $this->arme = $arme;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }
}
