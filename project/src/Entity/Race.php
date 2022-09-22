<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RaceRepository::class)
 */
class Race
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
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusFOR;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusDEX;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusCON;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusINT;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusSAG;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusCHA;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bonusChoix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pv;

    /**
     * @ORM\OneToMany(targetEntity=Personnage::class, mappedBy="race", orphanRemoval=true)
     */
    private $personnages;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getBonusFOR(): ?int
    {
        return $this->bonusFOR;
    }

    public function setBonusFOR(?int $bonusFOR): self
    {
        $this->bonusFOR = $bonusFOR;

        return $this;
    }

    public function getBonusDEX(): ?int
    {
        return $this->bonusDEX;
    }

    public function setBonusDEX(?int $bonusDEX): self
    {
        $this->bonusDEX = $bonusDEX;

        return $this;
    }

    public function getBonusCON(): ?int
    {
        return $this->bonusCON;
    }

    public function setBonusCON(?int $bonusCON): self
    {
        $this->bonusCON = $bonusCON;

        return $this;
    }

    public function getBonusINT(): ?int
    {
        return $this->bonusINT;
    }

    public function setBonusINT(?int $bonusINT): self
    {
        $this->bonusINT = $bonusINT;

        return $this;
    }

    public function getBonusSAG(): ?int
    {
        return $this->bonusSAG;
    }

    public function setBonusSAG(?int $bonusSAG): self
    {
        $this->bonusSAG = $bonusSAG;

        return $this;
    }

    public function getBonusCHA(): ?int
    {
        return $this->bonusCHA;
    }

    public function setBonusCHA(?int $bonusCHA): self
    {
        $this->bonusCHA = $bonusCHA;

        return $this;
    }

    public function isBonusChoix(): ?bool
    {
        return $this->bonusChoix;
    }

    public function setBonusChoix(?bool $bonusChoix): self
    {
        $this->bonusChoix = $bonusChoix;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(?int $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->setRace($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getRace() === $this) {
                $personnage->setRace(null);
            }
        }

        return $this;
    }
}
