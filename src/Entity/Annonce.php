<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_visites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_favoris;

    /**
     * @ORM\ManyToMany(targetEntity=Favoris::class, mappedBy="id_annonce")
     */         
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity=PropositionAchat::class, mappedBy="id_annonce")
     */
    private $propositionAchats;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : 0})
     */
    private $Vendu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Sales_at;

    /**
     * @ORM\OneToOne(targetEntity=Bien::class, inversedBy="annonce", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Bien;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->propositionAchats = new ArrayCollection();
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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->titre);
    }

    public function getNbVisites(): ?int
    {
        return $this->nb_visites;
    }

    public function setNbVisites(?int $nb_visites): self
    {
        $this->nb_visites = $nb_visites;

        return $this;
    }

    public function getNbFavoris(): ?int
    {
        return $this->nb_favoris;
    }

    public function setNbFavoris(?int $nb_favoris): self
    {
        $this->nb_favoris = $nb_favoris;

        return $this;
    }


    /**
     * @return Collection|Favoris[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addIdAnnonce($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeIdAnnonce($this);
        }

        return $this;
    }

    /**
     * @return Collection|PropositionAchat[]
     */
    public function getPropositionAchats(): Collection
    {
        return $this->propositionAchats;
    }

    public function addPropositionAchat(PropositionAchat $propositionAchat): self
    {
        if (!$this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats[] = $propositionAchat;
            $propositionAchat->setIdAnnonce($this);
        }

        return $this;
    }

    public function removePropositionAchat(PropositionAchat $propositionAchat): self
    {
        if ($this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats->removeElement($propositionAchat);
            // set the owning side to null (unless already changed)
            if ($propositionAchat->getIdAnnonce() === $this) {
                $propositionAchat->setIdAnnonce(null);
            }
        }

        return $this;
    }

    public function getVendu(): ?bool
    {
        return $this->Vendu;
    }

    public function setVendu(?bool $Vendu): self
    {
        $this->Vendu = $Vendu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeInterface $Created_at): self
    {
        $this->Created_at = $Created_at;

        return $this;
    }

    public function getSalesAt(): ?\DateTimeInterface
    {
        return $this->Sales_at;
    }

    public function setSalesAt(?\DateTimeInterface $Sales_at): self
    {
        $this->Sales_at = $Sales_at;

        return $this;
    }

    public function getBien(): ?Bien
    {
        return $this->Bien;
    }

    public function setBien(Bien $Bien): self
    {
        $this->Bien = $Bien;

        return $this;
    }
}
