<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
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
     * @ORM\Column(type="string", length=255)
     */
    private $caracteristique;

    /**
     * @ORM\OneToMany(targetEntity=PersoCompetence::class, mappedBy="competence", orphanRemoval=true)
     */
    private $persoCompetence;

    
    public function __construct()
    {
        $this->personnages = new ArrayCollection();
        $this->persoCompetence = new ArrayCollection();
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

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return Collection<int, PersoCompetence>
     */
    public function getPersoCompetence(): Collection
    {
        return $this->persoCompetence;
    }

    public function addPersoCompetence(PersoCompetence $persoCompetence): self
    {
        if (!$this->persoCompetence->contains($persoCompetence)) {
            $this->persoCompetence[] = $persoCompetence;
            $persoCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removePersoCompetence(PersoCompetence $persoCompetence): self
    {
        if ($this->persoCompetence->removeElement($persoCompetence)) {
            // set the owning side to null (unless already changed)
            if ($persoCompetence->getCompetence() === $this) {
                $persoCompetence->setCompetence(null);
            }
        }

        return $this;
    }
}
