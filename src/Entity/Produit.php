<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[UniqueEntity(fields:'nom',message:'le nom doit etre unique')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(["produit" => "Produit", "boisson" => "Boisson", "portionFrite" => "PortionFrite", "menu" => "Menu", "burger" =>"Burger" ])]
#[ApiResource]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["burger:read:simple","burger:read:all","write","menu:read:all","commande:write","taille:write","boisson:write","boisson:read:simple","boisson:read:all","taille:read:all","write:menu"])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
   // #[Assert\NotBlank(message:'le nom du burger est obligatoire')]
    #[Groups(["burger:read:simple","burger:read:all","write","menu:read:all","boisson:read:simple","boisson:read:all","boisson:read:all","write:menu"])]
    protected $nom;

    #[ORM\Column(type: 'blob', nullable:true)]
    #[Groups(["burger:read:simple","burger:read:all","boisson:read:simple","boisson:read:all"])]
    //#[Assert\NotBlank(message:'le burger doit avoir une image')]
    protected $image;

    #[ORM\Column(type: 'integer', nullable:true)]
    //#[Assert\NotBlank(message:'le prix est obligatoire')]
    #[Groups(["burger:read:simple","burger:read:all","write","menu:read:all"])]  
    protected $prix;

    #[ORM\Column(type: 'string', length: 255,nullable:true)]
    #[Groups(["burger:read:all"])]
    protected $etat="disponible";

    #[ORM\Column(type: 'text', nullable:true)]
    #[Groups(["burger:read:simple","burger:read:all","write","menu:read:all","boisson:read:simple","boisson:read:all"])]
    // #[Assert\NotBlank(message:'le burger doit avoir une description')]
    protected $description;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    #[Groups(["write","write:menu"])]
    #[SerializedName("image")]
    public ?file $file=null;

   // #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'float', nullable: true)]
    private $stock;

    public function __construct()
    {
        $this->produitCommandes = new ArrayCollection();
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

    public function getImage()
    {
        return utf8_encode(base64_encode($this->image));
        //return base64_encode(stream_get_contents($this->image));
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ProduitCommande>
     */
    public function getProduitCommandes(): Collection
    {
        return $this->produitCommandes;
    }

   

    public function getProduitCommande(): ?ProduitCommande
    {
        return $this->produitCommande;
    }

    public function setProduitCommande(?ProduitCommande $produitCommande): self
    {
        $this->produitCommande = $produitCommande;

        return $this;
    }

    public function addProduitCommande(ProduitCommande $produitCommande): self
    {
        if (!$this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes[] = $produitCommande;
            $produitCommande->setProduit($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommandes->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getProduit() === $this) {
                $produitCommande->setProduit(null);
            }
        }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
