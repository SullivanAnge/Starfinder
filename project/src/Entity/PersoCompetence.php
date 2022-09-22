<?php

namespace App\Entity;

use App\Repository\PersoCompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersoCompetenceRepository::class)
 */
class PersoCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $CompClasse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonusClasse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modCarac;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modDivers;

    /**
     * @ORM\ManyToOne(targetEntity=Personnage::class, inversedBy="competences")
     */
    private $personnage;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="persoCompetence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCompClasse(): ?bool
    {
        return $this->CompClasse;
    }

    public function setCompClasse(bool $CompClasse): self
    {
        $this->CompClasse = $CompClasse;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getBonusClasse(): ?int
    {
        return $this->bonusClasse;
    }

    public function setBonusClasse(int $bonusClasse): self
    {
        $this->bonusClasse = $bonusClasse;

        return $this;
    }

    public function getModCarac(): ?int
    {
        return $this->modCarac;
    }

    public function setModCarac(?int $modCarac): self
    {
        $this->modCarac = $modCarac;

        return $this;
    }

    public function getModDivers(): ?int
    {
        return $this->modDivers;
    }

    public function setModDivers(?int $modDivers): self
    {
        $this->modDivers = $modDivers;

        return $this;
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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
