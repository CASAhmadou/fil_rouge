<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Service\ValidationCommande;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Cascade;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['commande:read:simple']],
        ],
        "post" => [
            "security_post_denormalize" => "is_granted('COMMANDE_CREATE', object)",
            "security_post_denormalize_message" => "Client non Connecte",

            'denormalization_context' => ['groups' => ['commande:write']],
            'normalization_context' => ['groups' => ['commande:read:all']],
        ]],
    itemOperations: [
        "get" => [ "security" => "is_granted('COMPLEMENT_READ', commande)" ],
        "put" => [ "security" => "is_granted('COMPLEMENT_EDIT', commande)" ],
        "delete" => [ "security" => "is_granted('COMPLEMENT_DELETE', commande)" ],
    ],
 )]

 #[Assert\Callback([ValidationCommande::class, 'ValideCommande'])]
#[Assert\Callback([ValidationCommande::class, 'TestCommande'])]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["commande:read:simple","commande:read:all"])]
    private $numeroCommande;

    #[ORM\Column(type: 'date', nullable:true)]
    #[Groups(["commanderead:simple","commande:read:all"])]
    private $dateCommande;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["commande:read:simple","commande:read:all"])]
    private $etat="Traitement en cours";

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["commande:read:simple","commande:read:all"])]
    private $montantCommande;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    #[Groups(["burger:read:simple","burger:read:all"])]
    private $livraison;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $client;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    #[Groups(["commande:read:simple","commande:read:all"])]
    private $zone;

    #[ORM\ManyToOne(targetEntity: Quartier::class, inversedBy: 'commandes')]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $quartier;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeMenu::class, cascade:['persist'])]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $commandeMenus;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeBurger::class, cascade:['persist'])]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $commandeBurgers;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeBoisson::class, cascade:['persist'])]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $commandeBoissons;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeFrite::class, cascade:['persist'])]
    #[Groups(["commande:write","commande:read:simple","commande:read:all"])]
    private $commandeFrites;


    public function __construct()
    {
        $this->produitCommandes = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->burger = new ArrayCollection();
        $this->boisson = new ArrayCollection();
        $this->frite = new ArrayCollection();
        $this->commandeMenus = new ArrayCollection();
        $this->commandeBurgers = new ArrayCollection();
        $this->commandeBoissons = new ArrayCollection();
        $this->commandeFrites = new ArrayCollection();
        $this->dateCommande = new \DateTime('NOW');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCommande(): ?string
    {
        return $this->numeroCommande;
    }

    public function setNumeroCommande(string $numeroCommande): self
    {
        $this->numeroCommande = $numeroCommande;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMontantCommande(): ?string
    {
        return $this->montantCommande;
    }

    public function setMontantCommande(string $montantCommande): self
    {
        $this->montantCommande = $montantCommande;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * @return Collection<int, ProduitCommande>
     */
    public function getProduitCommandes(): Collection
    {
        return $this->produitCommandes;
    }

    public function addProduitCommande(ProduitCommande $produitCommande): self
    {
        if (!$this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes[] = $produitCommande;
            $produitCommande->setCommande($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommandes->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getCommande() === $this) {
                $produitCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * @return Collection<int, CommandeMenu>
     */
    public function getCommandeMenus(): Collection
    {
        return $this->commandeMenus;
    }

    public function addCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if (!$this->commandeMenus->contains($commandeMenu)) {
            $this->commandeMenus[] = $commandeMenu;
            $commandeMenu->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if ($this->commandeMenus->removeElement($commandeMenu)) {
            // set the owning side to null (unless already changed)
            if ($commandeMenu->getCommande() === $this) {
                $commandeMenu->setCommande(null);
            }
        }

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
            $commandeBurger->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getCommande() === $this) {
                $commandeBurger->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeBoisson>
     */
    public function getCommandeBoissons(): Collection
    {
        return $this->commandeBoissons;
    }

    public function addCommandeBoisson(CommandeBoisson $commandeBoisson): self
    {
        if (!$this->commandeBoissons->contains($commandeBoisson)) {
            $this->commandeBoissons[] = $commandeBoisson;
            $commandeBoisson->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeBoisson(CommandeBoisson $commandeBoisson): self
    {
        if ($this->commandeBoissons->removeElement($commandeBoisson)) {
            // set the owning side to null (unless already changed)
            if ($commandeBoisson->getCommande() === $this) {
                $commandeBoisson->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeFrite>
     */
    public function getCommandeFrites(): Collection
    {
        return $this->commandeFrites;
    }

    public function addCommandeFrite(CommandeFrite $commandeFrite): self
    {
        if (!$this->commandeFrites->contains($commandeFrite)) {
            $this->commandeFrites[] = $commandeFrite;
            $commandeFrite->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeFrite(CommandeFrite $commandeFrite): self
    {
        if ($this->commandeFrites->removeElement($commandeFrite)) {
            // set the owning side to null (unless already changed)
            if ($commandeFrite->getCommande() === $this) {
                $commandeFrite->setCommande(null);
            }
        }

        return $this;
    }

  
}