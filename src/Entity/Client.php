<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => [
                'groups' => ['burger:read:simple']
            ],
        ],
        "post_register" => [
            "method"=>"post",
            'path'=>'/register/client',
            'denormalization_context' => ['groups' => ['write']],
            'normalization_context' => ['groups' => ['burger:read:simple']],
        ],
        "add" => [
            'method' => 'get',
            "path"=>"/email",
            "controller"=>MailerController::class,
            ]
        ],
        attributes: ["pagination_items_per_page" => 5]

)]
class Client extends User
{
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["burger:read:simple", "commande:write"])]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["burger:read:simple", "commande:write"])]
    private $telephone;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class,cascade:['persist'])]
    #[Groups(["burger:read:simple"])]
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }
   
}
