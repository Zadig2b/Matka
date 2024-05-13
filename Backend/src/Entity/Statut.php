<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]

class Statut
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false, options: ['unsigned' => true])] // Add options
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, DemandeGenerale>
     */
    #[ORM\OneToMany(targetEntity: DemandeGenerale::class, mappedBy: 'Statut')]
    private Collection $demandeGenerales;

    /**
     * @var Collection<int, Demande>
     */
    #[ORM\OneToMany(targetEntity: Demande::class, mappedBy: 'Statut')]
    private Collection $demandes;

    public function __construct()
    {
        $this->demandeGenerales = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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
     * @return Collection<int, DemandeGenerale>
     */
    public function getDemandeGenerales(): Collection
    {
        return $this->demandeGenerales;
    }

    public function addDemandeGenerale(DemandeGenerale $demandeGenerale): static
    {
        if (!$this->demandeGenerales->contains($demandeGenerale)) {
            $this->demandeGenerales->add($demandeGenerale);
            $demandeGenerale->setStatut($this);
        }

        return $this;
    }

    public function removeDemandeGenerale(DemandeGenerale $demandeGenerale): static
    {
        if ($this->demandeGenerales->removeElement($demandeGenerale)) {
            // set the owning side to null (unless already changed)
            if ($demandeGenerale->getStatut() === $this) {
                $demandeGenerale->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setStatut($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getStatut() === $this) {
                $demande->setStatut(null);
            }
        }

        return $this;
    }
}
