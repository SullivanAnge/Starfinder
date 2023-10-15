<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnageRepository::class)
 */
class Personnage
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
    private $Nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracFOR;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracDEX;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracCON;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracINT;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracSAG;

    /**
     * @ORM\Column(type="integer")
     */
    private $modForce;

    /**
     * @ORM\Column(type="integer")
     */
    private $modDex;

    /**
     * @ORM\Column(type="integer")
     */
    private $modCon;

    /**
     * @ORM\Column(type="integer")
     */
    private $modInt;

    /**
     * @ORM\Column(type="integer")
     */
    private $modSag;

    /**
     * @ORM\Column(type="integer")
     */
    private $modCha;

    /**
     * @ORM\Column(type="integer")
     */
    private $PE;

    /**
     * @ORM\Column(type="integer")
     */
    private $PV;

    /**
     * @ORM\Column(type="integer")
     */
    private $PP;

    /**
     * @ORM\Column(type="integer")
     */
    private $CAE;

    /**
     * @ORM\Column(type="integer")
     */
    private $CAC;

    /**
     * @ORM\Column(type="integer")
     */
    private $vigueur;

    /**
     * @ORM\Column(type="integer")
     */
    private $reflexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $volonte;

    /**
     * @ORM\Column(type="integer")
     */
    private $attCac;

    /**
     * @ORM\Column(type="integer")
     */
    private $attDist;

    /**
     * @ORM\Column(type="integer")
     */
    private $attLancer;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity=Themes::class, inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $themes;

    /**
     * @ORM\OneToMany(targetEntity=PersoCompetence::class, mappedBy="personnage")
     */
    private $competences;

    /**
     * @ORM\Column(type="integer")
     */
    private $caracCHA;

    /**
     * @ORM\Column(type="integer")
     */
    private $points_competence;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonus_cae;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bonus_cac;

    

    public function __construct()
    {
        $this->perso_competence = new ArrayCollection();
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getCaracFOR(): ?int
    {
        return $this->caracFOR;
    }

    public function setCaracFOR(int $caracFOR): self
    {
        $this->caracFOR = $caracFOR;

        return $this;
    }

    public function getCaracDEX(): ?int
    {
        return $this->caracDEX;
    }

    public function setCaracDEX(int $caracDEX): self
    {
        $this->caracDEX = $caracDEX;

        return $this;
    }

    public function getCaracCON(): ?int
    {
        return $this->caracCON;
    }

    public function setCaracCON(int $caracCON): self
    {
        $this->caracCON = $caracCON;

        return $this;
    }

    public function getCaracINT(): ?int
    {
        return $this->caracINT;
    }

    public function setCaracINT(int $caracINT): self
    {
        $this->caracINT = $caracINT;

        return $this;
    }

    public function getCaracSAG(): ?int
    {
        return $this->caracSAG;
    }

    public function setCaracSAG(int $caracSAG): self
    {
        $this->caracSAG = $caracSAG;

        return $this;
    }

    public function getModForce(): ?int
    {
        return $this->modForce;
    }

    public function setModForce(int $modForce): self
    {
        $this->modForce = $modForce;

        return $this;
    }

    public function getModDex(): ?int
    {
        return $this->modDex;
    }

    public function setModDex(int $modDex): self
    {
        $this->modDex = $modDex;

        return $this;
    }

    public function getModCon(): ?int
    {
        return $this->modCon;
    }

    public function setModCon(int $modCon): self
    {
        $this->modCon = $modCon;

        return $this;
    }

    public function getModInt(): ?int
    {
        return $this->modInt;
    }

    public function setModInt(int $modInt): self
    {
        $this->modInt = $modInt;

        return $this;
    }

    public function getModSag(): ?int
    {
        return $this->modSag;
    }

    public function setModSag(int $modSag): self
    {
        $this->modSag = $modSag;

        return $this;
    }

    public function getModCha(): ?int
    {
        return $this->modCha;
    }

    public function setModCha(int $modCha): self
    {
        $this->modCha = $modCha;

        return $this;
    }

    public function getPE(): ?int
    {
        return $this->PE;
    }

    public function setPE(int $PE): self
    {
        $this->PE = $PE;

        return $this;
    }

    public function getPV(): ?int
    {
        return $this->PV;
    }

    public function setPV(int $PV): self
    {
        $this->PV = $PV;

        return $this;
    }

    public function getPP(): ?int
    {
        return $this->PP;
    }

    public function setPP(int $PP): self
    {
        $this->PP = $PP;

        return $this;
    }

    public function getCAE(): ?int
    {
        return $this->CAE;
    }

    public function setCAE(int $CAE): self
    {
        $this->CAE = $CAE;

        return $this;
    }

    public function getCAC(): ?int
    {
        return $this->CAC;
    }

    public function setCAC(int $CAC): self
    {
        $this->CAC = $CAC;

        return $this;
    }

    public function getVigueur(): ?int
    {
        return $this->vigueur;
    }

    public function setVigueur(int $vigueur): self
    {
        $this->vigueur = $vigueur;

        return $this;
    }

    public function getReflexe(): ?int
    {
        return $this->reflexe;
    }

    public function setReflexe(int $reflexe): self
    {
        $this->reflexe = $reflexe;

        return $this;
    }

    public function getVolonte(): ?int
    {
        return $this->volonte;
    }

    public function setVolonte(int $volonte): self
    {
        $this->volonte = $volonte;

        return $this;
    }

    public function getAttCac(): ?int
    {
        return $this->attCac;
    }

    public function setAttCac(int $attCac): self
    {
        $this->attCac = $attCac;

        return $this;
    }

    public function getAttDist(): ?int
    {
        return $this->attDist;
    }

    public function setAttDist(int $attDist): self
    {
        $this->attDist = $attDist;

        return $this;
    }

    public function getAttLancer(): ?int
    {
        return $this->attLancer;
    }

    public function setAttLancer(int $attLancer): self
    {
        $this->attLancer = $attLancer;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getThemes(): ?Themes
    {
        return $this->themes;
    }

    public function setThemes(?Themes $themes): self
    {
        $this->themes = $themes;

        return $this;
    }

    /**
     * @return Collection<int, PersoCompetence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(PersoCompetence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setPersonnage($this);
        }

        return $this;
    }

    public function removeCompetence(PersoCompetence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getPersonnage() === $this) {
                $competence->setPersonnage(null);
            }
        }

        return $this;
    }

    public function getCaracCHA(): ?int
    {
        return $this->caracCHA;
    }

    public function setCaracCHA(int $caracCHA): self
    {
        $this->caracCHA = $caracCHA;

        return $this;
    }

    public function getPointsCompetence(): ?int
    {
        return $this->points_competence;
    }

    public function setPointsCompetence(int $points_competence): self
    {
        $this->points_competence = $points_competence;

        return $this;
    }

    public function getBonusCae(): ?int
    {
        return $this->bonus_cae;
    }

    public function setBonusCae(?int $bonus_cae): self
    {
        $this->bonus_cae = $bonus_cae;

        return $this;
    }

    public function getBonusCac(): ?int
    {
        return $this->bonus_cac;
    }

    public function setBonusCac(?int $bonus_cac): self
    {
        $this->bonus_cac = $bonus_cac;

        return $this;
    }

    
}
