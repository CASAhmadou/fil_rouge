<?php

namespace App\DataProviders;

use App\Entity\Taille;
use App\Entity\Complement;
use App\Entity\PortionFrite;
use App\Repository\TailleRepository;
use App\Repository\PortionFriteRepository;
use App\Repository\TailleBoissonRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

class ComplementsDataProviders implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private PortionFriteRepository $repo;
    private TailleBoissonRepository $reposit;

    public function __construct(PortionFriteRepository $repo, TailleBoissonRepository $reposit)
    {
        $this->repo = $repo;
        $this->reposit = $reposit;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Complement::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $catalogue=[];
        $burgers= $this->repo->findby(["etat"=>"DISPONIBLE"]);
        $menus= $this->reposit->findby(["etat"=>"DISPONIBLE"]);
        foreach ($burgers as  $burger)
        {
           $catalogue[]=$burger;
        }

        foreach ($menus as $menu) 
        {
            $catalogue[]=$menu;
        }

         return $catalogue;
    }
}