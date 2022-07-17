<?php

namespace App\Service;

use App\Entity\Commande;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ValidationCommande
{

    public static function valideCommande($object, ExecutionContextInterface $context, $payload)
    {
        $menu=count($object->getCommandeMenus());
        $burger=count($object->getCommandeBurgers());
        if(($menu==0) && ($burger==0)){
            $context->buildViolation("La commande doit avoir au moins un type")
            ->addViolation();
        }       
    }

    public static function TestCommande($object, ExecutionContextInterface $context, $payload)
    {
         $array = [];

         foreach ($object->getCommandeMenus() as  $menu) {
            $array[] = $menu->getMenu();

         }
            //dd($array);
            $notDoub = array_unique($array, SORT_REGULAR);

        if (count($menu->getCommandeMenus()) != count($notDoub)) {
              $context->buildViolation("Vous avez ajouter deux Menus identiques")
              ->addViolation();
        }
    }

    public function Quantity(){
        
    }
}