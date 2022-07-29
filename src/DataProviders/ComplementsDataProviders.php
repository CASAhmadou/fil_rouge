<?php

namespace App\DataProviders;

use App\Entity\Taille;
use App\Entity\PortionFrite;
use App\Entity\Dto\Complement;
use App\Repository\TailleRepository;
use App\Repository\PortionFriteRepository;
use App\Repository\TailleBoissonRepository;
use App\Entity\Dto\Complement as DtoComplement;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ComplementsDataProviders implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private  $complement;

    public function __construct(PortionFriteRepository $frite, TailleBoissonRepository $boisson)
    {
        $this->coomplement = new Complement($frite,$boisson);
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Complement::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $complement=[];
        $complement['portionFrites']=$this->complement->getTailleBoissons();
        $complement['tailleBoissons']=$this->complement->getPortionFrite();

        // $burgers= $this->repo->findby(["etat"=>"disponible"]);
        // $menus= $this->reposit->findby(["etat"=>"disponible"]);


        // foreach ($burgers as  $burger)
        // {
        //    $catalogue[]=$burger;
        // }

        // foreach ($menus as $menu) 
        // {
        //     $catalogue[]=$menu;
        // }

         return $complement;
    }
}