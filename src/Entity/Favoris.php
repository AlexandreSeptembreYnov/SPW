<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavorisRepository::class)
 */
class Favoris
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="favoris")
     */
    private $id_Client;

    /**
     * @ORM\ManyToMany(targetEntity=Annonce::class, inversedBy="favoris")
     */
    private $id_annonce;

    public function __construct()
    {
        $this->id_Client = new ArrayCollection();
        $this->id_annonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return Collection|Client[]
     */
    public function getIdClient(): Collection
    {
        return $this->id_Client;
    }

    public function addIdClient(Client $idClient): self
    {
        if (!$this->id_Client->contains($idClient)) {
            $this->id_Client[] = $idClient;
        }

        return $this;
    }

    public function removeIdClient(Client $idClient): self
    {
        if ($this->id_Client->contains($idClient)) {
            $this->id_Client->removeElement($idClient);
        }

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getIdAnnonce(): Collection
    {
        return $this->id_annonce;
    }

    public function addIdAnnonce(Annonce $idAnnonce): self
    {
        if (!$this->id_annonce->contains($idAnnonce)) {
            $this->id_annonce[] = $idAnnonce;
        }

        return $this;
    }

    public function removeIdAnnonce(Annonce $idAnnonce): self
    {
        if ($this->id_annonce->contains($idAnnonce)) {
            $this->id_annonce->removeElement($idAnnonce);
        }

        return $this;
    }
}
