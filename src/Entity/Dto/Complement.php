<?php

namespace App\Entity\Dto;

use App\Entity\PortionFrite;
use App\Entity\TailleBoisson;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

//#[ORM\Entity(repositoryClass: ComplementRepository::class)]
#[ApiResource]
class Complement
{
   // #[ORM\Id]
   // #[ORM\GeneratedValue]
   // #[ORM\Column(type: 'integer')]
    private $id;

    //#[ORM\OneToMany(mappedBy: 'complement', targetEntity: PortionFrite::class)]
    private $portionFrites;

    //#[ORM\OneToMany(mappedBy: 'complement', targetEntity: TailleBoisson::class)]
    private $tailleBoissons;

    public function __construct()
    {
        $this->portionFrites = new ArrayCollection();
        $this->tailleBoissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PortionFrite>
     */
    public function getPortionFrites(): Collection
    {
        return $this->portionFrites;
    }

    public function addPortionFrite(PortionFrite $portionFrite): self
    {
        if (!$this->portionFrites->contains($portionFrite)) {
            $this->portionFrites[] = $portionFrite;
            $portionFrite->setComplement($this);
        }

        return $this;
    }

    public function removePortionFrite(PortionFrite $portionFrite): self
    {
        if ($this->portionFrites->removeElement($portionFrite)) {
            // set the owning side to null (unless already changed)
            if ($portionFrite->getComplement() === $this) {
                $portionFrite->setComplement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleBoissons(): Collection
    {
        return $this->tailleBoissons;
    }

    public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if (!$this->tailleBoissons->contains($tailleBoisson)) {
            $this->tailleBoissons[] = $tailleBoisson;
            $tailleBoisson->setComplement($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoisson->getComplement() === $this) {
                $tailleBoisson->setComplement(null);
            }
        }

        return $this;
    }
}
