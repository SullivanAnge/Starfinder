<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
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
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carac_e;

    /**
     * @ORM\Column(type="integer")
     */
    private $pv;

    /**
     * @ORM\Column(type="integer")
     */
    private $pe;

    /**
     * @ORM\Column(type="integer")
     */
    private $competence_niveau;

    /**
     * @ORM\OneToMany(targetEntity=Personnage::class, mappedBy="classe")
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCaracE(): ?string
    {
        return $this->carac_e;
    }

    public function setCaracE(string $carac_e): self
    {
        $this->carac_e = $carac_e;

        return $this;
    }

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(int $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getPe(): ?int
    {
        return $this->pe;
    }

    public function setPe(int $pe): self
    {
        $this->pe = $pe;

        return $this;
    }

    public function getCompetenceNiveau(): ?int
    {
        return $this->competence_niveau;
    }

    public function setCompetenceNiveau(int $competence_niveau): self
    {
        $this->competence_niveau = $competence_niveau;

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
            $personnage->setClasse($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getClasse() === $this) {
                $personnage->setClasse(null);
            }
        }

        return $this;
    }
}
