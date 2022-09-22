<?php

namespace App\Entity;

use App\Repository\ThemesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemesRepository::class)
 */
class Themes
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
     * @ORM\Column(type="integer")
     */
    private $bonusFOR;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonusDex;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonusCON;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonusINT;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonusSAG;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonusCHA;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bonusChoix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $txt;

    /**
     * @ORM\OneToMany(targetEntity=Personnage::class, mappedBy="themes", orphanRemoval=true)
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

    public function setBonusFOR(int $bonusFOR): self
    {
        $this->bonusFOR = $bonusFOR;

        return $this;
    }

    public function getBonusDex(): ?int
    {
        return $this->bonusDex;
    }

    public function setBonusDex(int $bonusDex): self
    {
        $this->bonusDex = $bonusDex;

        return $this;
    }

    public function getBonusCON(): ?int
    {
        return $this->bonusCON;
    }

    public function setBonusCON(int $bonusCON): self
    {
        $this->bonusCON = $bonusCON;

        return $this;
    }

    public function getBonusINT(): ?int
    {
        return $this->bonusINT;
    }

    public function setBonusINT(int $bonusINT): self
    {
        $this->bonusINT = $bonusINT;

        return $this;
    }

    public function getBonusSAG(): ?int
    {
        return $this->bonusSAG;
    }

    public function setBonusSAG(int $bonusSAG): self
    {
        $this->bonusSAG = $bonusSAG;

        return $this;
    }

    public function getBonusCHA(): ?int
    {
        return $this->bonusCHA;
    }

    public function setBonusCHA(int $bonusCHA): self
    {
        $this->bonusCHA = $bonusCHA;

        return $this;
    }

    public function getBonusChoix(): ?bool
    {
        return $this->bonusChoix;
    }

    public function setBonusChoix(bool $bonusChoix): self
    {
        $this->bonusChoix = $bonusChoix;

        return $this;
    }

    public function getTxt(): ?string
    {
        return $this->txt;
    }

    public function setTxt(?string $txt): self
    {
        $this->txt = $txt;

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
            $personnage->setThemes($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getThemes() === $this) {
                $personnage->setThemes(null);
            }
        }

        return $this;
    }
}
