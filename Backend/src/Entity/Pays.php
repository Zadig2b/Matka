<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, voyage>
     */
    #[ORM\ManyToMany(targetEntity: voyage::class, inversedBy: 'pays')]
    private Collection $pays_voyage;

    public function __construct()
    {
        $this->pays_voyage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, voyage>
     */
    public function getPaysVoyage(): Collection
    {
        return $this->pays_voyage;
    }

    public function addPaysVoyage(voyage $paysVoyage): static
    {
        if (!$this->pays_voyage->contains($paysVoyage)) {
            $this->pays_voyage->add($paysVoyage);
        }

        return $this;
    }

    public function removePaysVoyage(voyage $paysVoyage): static
    {
        $this->pays_voyage->removeElement($paysVoyage);

        return $this;
    }
}
