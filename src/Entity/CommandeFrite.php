<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeFriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeFriteRepository::class)]
#[ApiResource]
class CommandeFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $id;

    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'commandeFrites')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $frite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeFrites')]
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

    public function getFrite(): ?PortionFrite
    {
        return $this->frite;
    }

    public function setFrite(?PortionFrite $frite): self
    {
        $this->frite = $frite;

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
