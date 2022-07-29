<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Produit;
use App\Entity\Gestionnaire;
use App\Entity\Dto\Catalogue;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:simple']],
        ]
    ,"post"=>[
            //'deserialize'=>false,
            'denormalization_context' => ['groups' => ['write']],
            'normalization_context' => ['groups' => ['burger:read:all']],
            'input_formats' => ['multipart' => ['multipart/form-data']],
            "security"=>"is_granted('ROLE_GESTIONNAIRE')",
            "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
    itemOperations:[
        "put"=>[
            "security"=>"is_granted('ROLE_GESTIONNAIRE')",
            "security_message"=>"Vous n'avez pas access à cette Ressource",
        ],
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['burger:read:all']],
            'input_formats' => [
                'multipart' => ['multipart/form-data'],
            ],
        ],
        "delete"=>[
            "security"=>"is_granted('ROLE_GESTIONNAIRE')",
            "security_message"=>"Vous n'avez pas access à cette Ressource",
           ]
    ],
    attributes: [
        "pagination_items_per_page" => 5
    ],
)]
class Burger extends Produit
{

    private $catalogue;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurger::class, cascade:['persist'])]
    #[Groups(["burger:read:simple"])]
    private $menuBurgers;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: CommandeBurger::class, cascade:['persist'])]
    private $commandeBurgers;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: DetailProduit::class)]
    private Collection $detailProduits;

    public function __construct()
    {
        parent::__construct();
        $this->menuBurgers = new ArrayCollection();
        $this->commandeBurgers = new ArrayCollection();
        $this->detailProduits = new ArrayCollection();
    }

   

  
    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, MenuBurger>
     */
    public function getMenuBurgers(): Collection
    {
        return $this->menuBurgers;
    }

    public function addMenuBurger(MenuBurger $menuBurger): self
    {
        if (!$this->menuBurgers->contains($menuBurger)) {
            $this->menuBurgers[] = $menuBurger;
            $menuBurger->setBurger($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getBurger() === $this) {
                $menuBurger->setBurger(null);
            }
        }

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

    /**
     * @return Collection<int, CommandeBurger>
     */
    public function getCommandeBurgers(): Collection
    {
        return $this->commandeBurgers;
    }

    public function addCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if (!$this->commandeBurgers->contains($commandeBurger)) {
            $this->commandeBurgers[] = $commandeBurger;
            $commandeBurger->setBurger($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getBurger() === $this) {
                $commandeBurger->setBurger(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailProduit>
     */
    public function getDetailProduits(): Collection
    {
        return $this->detailProduits;
    }

    public function addDetailProduit(DetailProduit $detailProduit): self
    {
        if (!$this->detailProduits->contains($detailProduit)) {
            $this->detailProduits->add($detailProduit);
            $detailProduit->setBurger($this);
        }

        return $this;
    }

    public function removeDetailProduit(DetailProduit $detailProduit): self
    {
        if ($this->detailProduits->removeElement($detailProduit)) {
            // set the owning side to null (unless already changed)
            if ($detailProduit->getBurger() === $this) {
                $detailProduit->setBurger(null);
            }
        }

        return $this;
    }

  
}
