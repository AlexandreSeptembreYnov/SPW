<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 */
class Bien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $superficie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pieces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $jardin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cave;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ceillier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $loggia;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $terrasse;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $garage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $verranda;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix_min;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="id_Bien")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity=Annonce::class, mappedBy="Bien", cascade={"persist", "remove"})
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity=Vendeur::class, inversedBy="Bien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendeur;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(?float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getNbPieces(): ?int
    {
        return $this->nb_pieces;
    }

    public function setNbPieces(?int $nb_pieces): self
    {
        $this->nb_pieces = $nb_pieces;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(?bool $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }

    public function getCave(): ?bool
    {
        return $this->cave;
    }

    public function setCave(?bool $cave): self
    {
        $this->cave = $cave;

        return $this;
    }

    public function getCeillier(): ?bool
    {
        return $this->ceillier;
    }

    public function setCeillier(?bool $ceillier): self
    {
        $this->ceillier = $ceillier;

        return $this;
    }

    public function getLoggia(): ?bool
    {
        return $this->loggia;
    }

    public function setLoggia(?bool $loggia): self
    {
        $this->loggia = $loggia;

        return $this;
    }

    public function getTerrasse(): ?bool
    {
        return $this->terrasse;
    }

    public function setTerrasse(?bool $terrasse): self
    {
        $this->terrasse = $terrasse;

        return $this;
    }

    public function getGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(?bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getVerranda(): ?bool
    {
        return $this->verranda;
    }

    public function setVerranda(?bool $verranda): self
    {
        $this->verranda = $verranda;

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prix_min;
    }

    public function setPrixMin(?float $prix_min): self
    {
        $this->prix_min = $prix_min;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setIdBien($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getIdBien() === $this) {
                $image->setIdBien(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(Annonce $annonce): self
    {
        $this->annonce = $annonce;

        // set the owning side of the relation if necessary
        if ($annonce->getBien() !== $this) {
            $annonce->setBien($this);
        }

        return $this;
    }

    public function getVendeur(): ?Vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(?Vendeur $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }
}
