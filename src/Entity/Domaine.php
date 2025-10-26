<?php

namespace App\Entity;

use App\Repository\DomaineRepository;
use App\Utils\StringUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Util\StringUtil;

#[ORM\Entity(repositoryClass: DomaineRepository::class)]
class Domaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'domaine', targetEntity: Metier::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $metiers;

    #[ORM\OneToMany(mappedBy: 'domaine', targetEntity: Evaluation::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $evaluations;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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

    /** @return Collection<int, Metier> */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metier $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers->add($metier);
            $metier->setDomaine($this);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): self
    {
        if ($this->metiers->removeElement($metier)) {
            if ($metier->getDomaine() === $this) {
                $metier->setDomaine(null);
            }
        }

        return $this;
    }

    /** @return Collection<int, Evaluation> */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setDomaine($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            if ($evaluation->getDomaine() === $this) {
                $evaluation->setDomaine(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return StringUtils::mbUcfirst($this->nom);
    }
}
