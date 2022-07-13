<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProduitCommandeRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitCommandeRepository::class)]
#[ApiResource]
class ProduitCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["commande:write"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["write"])]
    private $qteProduit;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'produitCommandes')]
    #[Groups(["write"])]
    private $produit;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'produitCommandes')]
    private $commande;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteProduit(): ?string
    {
        return $this->qteProduit;
    }

    public function setQteProduit(string $qteProduit): self
    {
        $this->qteProduit = $qteProduit;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

  
}
