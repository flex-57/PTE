<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use App\Utils\StringUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Domaine::class, inversedBy: 'metiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Domaine $domaine = null;

    #[ORM\ManyToMany(inversedBy: 'metiers', targetEntity: Critere::class, cascade: ['persist'])]
    private Collection $criteres;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return StringUtils::mbUcfirst($this->nom);
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return StringUtils::mbUcfirst($this->description);
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    /** @return Collection<int, Critere> */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Critere $critere): self
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres->add($critere);
            $critere->addMetier($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): self
    {
        if ($this->criteres->removeElement($critere)) {
            $critere->removeMetier($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return StringUtils::mbUcfirst($this->nom);
    }
}
