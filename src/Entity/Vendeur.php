<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VendeurRepository::class)
 */
class Vendeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $carte_identite;

    /**
     * @ORM\OneToOne(targetEntity=client::class, inversedBy="vendeur", cascade={"persist", "remove"})
     */
    private $id_Client;

    /**
     * @ORM\OneToMany(targetEntity=ContreProposition::class, mappedBy="id_Vendeur")
     */
    private $contrePropositions;

    /**
     * @ORM\OneToMany(targetEntity=Bien::class, mappedBy="vendeur", orphanRemoval=true)
     */
    private $Bien;

    public function __construct()
    {
        $this->contrePropositions = new ArrayCollection();
        $this->Bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarteIdentite()
    {
        return $this->carte_identite;
    }

    public function setCarteIdentite($carte_identite): self
    {
        $this->carte_identite = $carte_identite;

        return $this;
    }

    public function getIdClient(): ?client
    {
        return $this->id_Client;
    }

    public function setIdClient(?Client $id_Client): self
    {
        $this->id_Client = $id_Client;

        return $this;
    }

    /**
     * @return Collection|ContreProposition[]
     */
    public function getContrePropositions(): Collection
    {
        return $this->contrePropositions;
    }

    public function addContreProposition(ContreProposition $contreProposition): self
    {
        if (!$this->contrePropositions->contains($contreProposition)) {
            $this->contrePropositions[] = $contreProposition;
            $contreProposition->setIdVendeur($this);
        }

        return $this;
    }

    public function removeContreProposition(ContreProposition $contreProposition): self
    {
        if ($this->contrePropositions->contains($contreProposition)) {
            $this->contrePropositions->removeElement($contreProposition);
            // set the owning side to null (unless already changed)
            if ($contreProposition->getIdVendeur() === $this) {
                $contreProposition->setIdVendeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBien(): Collection
    {
        return $this->Bien;
    }

    public function addBien(Bien $bien): self
    {
        if (!$this->Bien->contains($bien)) {
            $this->Bien[] = $bien;
            $bien->setVendeur($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->Bien->contains($bien)) {
            $this->Bien->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getVendeur() === $this) {
                $bien->setVendeur(null);
            }
        }

        return $this;
    }
}
