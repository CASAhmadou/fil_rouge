<?php
namespace App\Service;

use App\Entity\Menu;
 
 class CalculPrixMenuService implements ICalculPrixMenu{

    public function calculPrixMenu(Menu $data): float{
        $prix=0;

        foreach($data->getMenuBurgers() as $burger){
            $menu = $burger->getBurger();
            $prix+= $menu->getPrix()*$burger->getQuantity();
        }
    
        foreach($data->getMenuPortionFrites() as $frite){
            $menu = $frite->getPortionFrite();
            $prix+= $menu->getPrix()*$frite->getQuantity();
        }
    
        foreach($data->getMenuTailleBoissons() as $boisson){
            $menu = $boisson->getTailleboisson();
            $prix+= $menu->getPrix()*$boisson->getQuantity();
        }

        return $prix;
    }

 }