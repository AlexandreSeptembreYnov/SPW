<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository", repositoryClass=ClientRepository::class)
 */
class Client implements UserInterface,Serializable
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Vendeur::class, mappedBy="id_Client", cascade={"persist", "remove"})
     */
    private $vendeur;

    /**
     * @ORM\ManyToMany(targetEntity=Favoris::class, mappedBy="id_Client")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity=PropositionAchat::class, mappedBy="id_client")
     */
    private $propositionAchats;

    public $role = ['ROLE_USER'];
    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->propositionAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVendeur(): ?Vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(?Vendeur $vendeur): self
    {
        $this->vendeur = $vendeur;

        // set (or unset) the owning side of the relation if necessary
        $newId_Client = null === $vendeur ? null : $this;
        if ($vendeur->getIdClient() !== $newId_Client) {
            $vendeur->setIdClient($newId_Client);
        }

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
            $favori->addIdClient($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeIdClient($this);
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
            $propositionAchat->setIdClient($this);
        }

        return $this;
    }

    public function removePropositionAchat(PropositionAchat $propositionAchat): self
    {
        if ($this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats->removeElement($propositionAchat);
            // set the owning side to null (unless already changed)
            if ($propositionAchat->getIdClient() === $this) {
                $propositionAchat->setIdClient(null);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->role;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @inheritDoc
     * @return mixed|string
     */
    public function serialize()
    {
            return serialize([
                $this->id,
                $this->email,
                $this->password
            ]);
        }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        /** @var Client $this */
        list(
            $this->id,
            $this->email,
            $this->password
            ) = $this->unserialize($serialized, ['allow_classes' => false]);
    }
}
