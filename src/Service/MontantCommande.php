<?php
namespace App\Service;


class  MontantCommande
{
    public function prixTotalCommande($data){
       //$data
       $montant = $data->getQuartier()->getZone()->getPrix();

        $menus = $data->getCommandeMenus();
        $burgers = $data->getCommandeBurgers();
        $boissons = $data->getCommandeBoissons();
        $frites = $data->getCommandeFrites();

        foreach($menus as $menu ){
            $menu->setPrix($menu->getMenu()->getPrix() * $menu->getQuantity());
            $montant += $menu->getMenu()->getPrix() * $menu->getQuantity();
        }

        foreach($burgers as $burger ){
            $burger->setPrix($burger->getBurger()->getPrix() * $burger->getQuantity());
            $montant += $burger->getBurger()->getPrix() * $burger->getQuantity();
        }

        foreach($boissons as $boisson ){
            $boisson->setPrix($boisson->getTailleBoisson()->getTaille()->getPrix() * $boisson->getQuantity());
            $montant += $boisson->getTailleBoisson()->getTaille()->getPrix() * $boisson->getQuantity();
        }

        foreach($frites as $frite ){
           // dd($frite);
            $frite->setPrix($frite->getFrite()->getPrix() * $frite->getQuantity());
            $montant += $frite->getFrite()->getPrix() * $frite->getQuantity();
        }
        return $montant;
    }


}