<?php

namespace App\Entity;

use App\Repository\PropositionAchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropositionAchatRepository::class)
 */
class PropositionAchat
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
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=client::class, inversedBy="propositionAchats")
     */
    private $id_client;

    /**
     * @ORM\ManyToOne(targetEntity=annonce::class, inversedBy="propositionAchats")
     */
    private $id_annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdClient(): ?client
    {
        return $this->id_client;
    }

    public function setIdClient(?client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdAnnonce(): ?annonce
    {
        return $this->id_annonce;
    }

    public function setIdAnnonce(?annonce $id_annonce): self
    {
        $this->id_annonce = $id_annonce;

        return $this;
    }
}
