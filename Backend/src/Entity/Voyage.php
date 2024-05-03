<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('api_voyage_methods')]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Groups('api_voyage_methods')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[Groups('api_voyage_methods')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;


    #[Groups('api_voyage_methods')]
    #[ORM\Column]
    private ?\DateInterval $duree = null;


    #[Groups('api_voyage_methods')]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;


    #[Groups('api_voyage_methods')]
    #[ORM\Column(length: 50)]
    private ?string $prix = null;


    #[Groups('api_voyage_methods')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, Categorie>
     */

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'relation')]
    
    private Collection $get_cat;

    #[ORM\ManyToOne(inversedBy: 'user_voyage')]
    private ?User $voyage_user = null;

    /**
     * @var Collection<int, Activites>
     */
    #[ORM\ManyToMany(targetEntity: Activites::class, inversedBy: 'voyage_par_Activites')]
    private Collection $Activites;

    /**
     * @var Collection<int, Pays>
     */
    #[ORM\ManyToMany(targetEntity: Pays::class, mappedBy: 'pays_voyage')]
    private Collection $pays;

    /**
     * @var Collection<int, Demande>
     */
    #[ORM\OneToMany(targetEntity: Demande::class, mappedBy: 'voyage', orphanRemoval: true)]
    private Collection $demandes;

    public function __construct()
    {
        $this->get_cat = new ArrayCollection();
        $this->Activites = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->demandes = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;
        $this->updateDuree();
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;
        $this->updateDuree();
        return $this;
    }

    public function getDuree(): ?\DateInterval
    {
        return $this->duree;
    }



    public function updateDuree(): void
    {
        if ($this->date_debut && $this->date_fin) {
            $this->duree = $this->date_fin->diff($this->date_debut);
        }
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    
    public function getGetCat(): Collection
    {
        return $this->get_cat;
    }

    public function addGetCat(Categorie $getCat): static
    {
        if (!$this->get_cat->contains($getCat)) {
            $this->get_cat->add($getCat);
            $getCat->addRelation($this);
        }

        return $this;
    }

    public function removeGetCat(Categorie $getCat): static
    {
        if ($this->get_cat->removeElement($getCat)) {
            $getCat->removeRelation($this);
        }

        return $this;
    }

    public function getVoyageUser(): ?User
    {
        return $this->voyage_user;
    }

    public function setVoyageUser(?User $voyage_user): static
    {
        $this->voyage_user = $voyage_user;

        return $this;
    }

    /**
     * @return Collection<int, Activites>
     */
    public function getActivites(): Collection
    {
        return $this->Activites;
    }

    public function addActivite(Activites $activite): static
    {
        if (!$this->Activites->contains($activite)) {
            $this->Activites->add($activite);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): static
    {
        $this->Activites->removeElement($activite);

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
            $pay->addPaysVoyage($this);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        if ($this->pays->removeElement($pay)) {
            $pay->removePaysVoyage($this);
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
            $demande->setVoyage($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getVoyage() === $this) {
                $demande->setVoyage(null);
            }
        }

        return $this;
    }
}
