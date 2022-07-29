<?php

namespace App\DataProviders;

use App\Entity\Dto\Catalogue;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class CatalogueDataProviders implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    private $burger;
    private $menu;

    public function __construct(BurgerRepository $burger,MenuRepository $menu)
    {
        $this->burger=$burger;
        $this->menu=$menu;
        
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Catalogue::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $catalogue=[];
        $catalogue['menu']=$this->menu-> findAll();
        $catalogue['burger']=$this->burger-> findAll();
        // dd($this->burger-> findAll());
        return $catalogue;
    }


}
