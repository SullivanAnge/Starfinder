<?php

namespace App\Entity;

use App\Repository\TypeArmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeArmeRepository::class)
 */
class TypeArme
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
     * @ORM\OneToMany(targetEntity=Arme::class, mappedBy="type")
     */
    private $armes;

    public function __construct()
    {
        $this->armes = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Arme>
     */
    public function getArmes(): Collection
    {
        return $this->armes;
    }

    public function addArme(Arme $arme): self
    {
        if (!$this->armes->contains($arme)) {
            $this->armes[] = $arme;
            $arme->setType($this);
        }

        return $this;
    }

    public function removeArme(Arme $arme): self
    {
        if ($this->armes->removeElement($arme)) {
            // set the owning side to null (unless already changed)
            if ($arme->getType() === $this) {
                $arme->setType(null);
            }
        }

        return $this;
    }
}
