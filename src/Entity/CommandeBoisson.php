<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeBoissonRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeBoissonRepository::class)]
#[ApiResource]
class CommandeBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $id;

    #[ORM\ManyToOne(targetEntity: BoissonTaille::class, inversedBy: 'commandeBoissons')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $tailleboisson;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeBoissons')]
    private $commande;

    #[ORM\Column(type: 'integer')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $quantity;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(["commande:read:simple","commande:read:all"])]
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTailleboisson(): ?BoissonTaille
    {
        return $this->tailleboisson;
    }

    public function setTailleboisson(?BoissonTaille $tailleboisson): self
    {
        $this->tailleboisson = $tailleboisson;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
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
}
