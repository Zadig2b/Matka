<?php

namespace App\Entity;

use App\Repository\ActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitesRepository::class)]
class Activites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Voyage>
     */
    #[ORM\ManyToMany(targetEntity: Voyage::class, mappedBy: 'Activites')]
    private Collection $voyage_par_Activites;

    public function __construct()
    {
        $this->voyage_par_Activites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyageParActivites(): Collection
    {
        return $this->voyage_par_Activites;
    }

    public function addVoyageParActivite(Voyage $voyageParActivite): static
    {
        if (!$this->voyage_par_Activites->contains($voyageParActivite)) {
            $this->voyage_par_Activites->add($voyageParActivite);
            $voyageParActivite->addActivite($this);
        }

        return $this;
    }

    public function removeVoyageParActivite(Voyage $voyageParActivite): static
    {
        if ($this->voyage_par_Activites->removeElement($voyageParActivite)) {
            $voyageParActivite->removeActivite($this);
        }

        return $this;
    }
}
