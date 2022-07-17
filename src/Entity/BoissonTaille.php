<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonTailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonTailleRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['boisson:read:simple']],
        ]
    ,"post"=>[
        'denormalization_context' => ['groups' => ['boisson:write']],
        'normalization_context' => ['groups' => ['boisson:read:all']],
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
    itemOperations:["put"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
    ],
    "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:all']],
        ],
    "delete"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
    attributes: ["pagination_items_per_page" => 5],
  
)]
class BoissonTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["boisson:write","boisson:read:all","commande:write","commande:read:simple","commande:read:all"])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'boissonTailles')]
    #[Groups(["boisson:write","boisson:read:all"])]
    private $boisson;

    #[ORM\Column(type: 'integer')]
    #[Groups(["boisson:write","boisson:read:all"])]
    private $qte;

    #[ORM\OneToMany(mappedBy: 'tailleboisson', targetEntity: CommandeBoisson::class, cascade:['persist'])]
    private $commandeBoissons;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'boissonTailles')]
    #[Groups(["boisson:write","boisson:read:all"])]
    private $taille;

    public function __construct()
    {
        $this->commandeBoissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaile(): ?TailleBoisson
    {
        return $this->taile;
    }

    public function setTaile(?TailleBoisson $taile): self
    {
        $this->taile = $taile;

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): self
    {
        $this->qte = $qte;

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
            $commandeBoisson->setTailleboisson($this);
        }

        return $this;
    }

    public function removeCommandeBoisson(CommandeBoisson $commandeBoisson): self
    {
        if ($this->commandeBoissons->removeElement($commandeBoisson)) {
            // set the owning side to null (unless already changed)
            if ($commandeBoisson->getTailleboisson() === $this) {
                $commandeBoisson->setTailleboisson(null);
            }
        }

        return $this;
    }

    public function getTaille(): ?TailleBoisson
    {
        return $this->taille;
    }

    public function setTaille(?TailleBoisson $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
