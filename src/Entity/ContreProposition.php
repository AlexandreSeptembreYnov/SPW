<?php

namespace App\Entity;

use App\Repository\ContrePropositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContrePropositionRepository::class)
 */
class ContreProposition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=vendeur::class, inversedBy="contrePropositions")
     */
    private $id_Vendeur;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity=propositionAchat::class, cascade={"persist", "remove"})
     */
    private $id_PropositionAchat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVendeur(): ?vendeur
    {
        return $this->id_Vendeur;
    }

    public function setIdVendeur(?vendeur $id_Vendeur): self
    {
        $this->id_Vendeur = $id_Vendeur;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdPropositionAchat(): ?propositionAchat
    {
        return $this->id_PropositionAchat;
    }

    public function setIdPropositionAchat(?propositionAchat $id_PropositionAchat): self
    {
        $this->id_PropositionAchat = $id_PropositionAchat;

        return $this;
    }
}
