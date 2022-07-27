<?php

namespace App\Entity;

use App\Entity\Boisson;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleBoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Dto\Complement;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['taille:read:simple']],
        ]
        ,"post"=>[
            'denormalization_context' => ['groups' => ['taille:write']],
            'normalization_context' => ['groups' => ['taille:read:all']],
            "security"=>"is_granted('ROLE_GESTIONNAIRE')",
            "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
    itemOperations:["put"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        'normalization_context' => ['groups' => ['taille:read:all']]
    ],
    "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['taille:read:all']],
        ],
    "delete"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
    attributes: ["pagination_items_per_page" => 5]
  
)]
class TailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["boisson:write","boisson:read:all","taille:read:all","taille:write","write:menu"])]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["taille:read:simple","taille:read:all","taille:write","boisson:read:all"])]
    private $prix;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["taille:read:simple","taille:read:all","taille:write","boisson:read:all"])]
    private $libelle;

    //#[ORM\ManyToOne(targetEntity: Complement::class, inversedBy: 'tailleBoissons')]
    //#[ORM\JoinColumn(nullable: true)]
    private $complement;

    #[ORM\OneToMany(mappedBy: 'tailleboisson', targetEntity: MenuTailleBoisson::class,cascade:['persist'])]
    private $menuTailleBoissons;

    #[ORM\Column(type: 'integer')]
    #[Groups(["taille:write","taille:read:all"])]
    private $stockTB;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: BoissonTaille::class, cascade:['persist'])]
    private $boissonTailles;

    public function __construct()
    {
        $this->boissonTailles = new ArrayCollection();
        $this->menuTailleBoissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

   

    public function getComplement(): ?Complement
    {
        return $this->complement;
    }

    public function setComplement(?Complement $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, BoissonTaille>
     */
    public function getBoissonTailles(): Collection
    {
        return $this->boissonTailles;
    }

    public function addBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if (!$this->boissonTailles->contains($boissonTaille)) {
            $this->boissonTailles[] = $boissonTaille;
            $boissonTaille->setTaile($this);
        }

        return $this;
    }

    public function removeBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if ($this->boissonTailles->removeElement($boissonTaille)) {
            // set the owning side to null (unless already changed)
            if ($boissonTaille->getTaile() === $this) {
                $boissonTaille->setTaile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuTailleBoisson>
     */
    public function getMenuTailleBoissons(): Collection
    {
        return $this->menuTailleBoissons;
    }

    public function addMenuTailleBoisson(MenuTailleBoisson $menuTailleBoisson): self
    {
        if (!$this->menuTailleBoissons->contains($menuTailleBoisson)) {
            $this->menuTailleBoissons[] = $menuTailleBoisson;
            $menuTailleBoisson->setTailleboisson($this);
        }

        return $this;
    }

    public function removeMenuTailleBoisson(MenuTailleBoisson $menuTailleBoisson): self
    {
        if ($this->menuTailleBoissons->removeElement($menuTailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($menuTailleBoisson->getTailleboisson() === $this) {
                $menuTailleBoisson->setTailleboisson(null);
            }
        }

        return $this;
    }

    public function getStockTB(): ?int
    {
        return $this->stockTB;
    }

    public function setStockTB(int $stockTB): self
    {
        $this->stockTB = $stockTB;

        return $this;
    }
}
