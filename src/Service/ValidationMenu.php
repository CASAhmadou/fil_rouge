<?php

namespace App\Service;

use App\Entity\Menu;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ValidationMenu
{
    public static function valideMenu($object, ExecutionContextInterface $context, $payload)
    {
        $portion=count($object->getMenuPortionFrites());
        $talles=count($object->getMenuTailleBoissons());
        if ($portion==0 && $talles==0) 
        {
            $context->buildViolation("Le menu doit avoir au moins un complement!!")
            ->addViolation();
        }
    }
    
    public static function TestMenu($object, ExecutionContextInterface $context, $payload)
    {
        $array = [];
        foreach ($object->getMenuBurgers() as  $burger) {
            $array[] = $burger->getBurger();
        }
        //dd($array);
        $notDoub = array_unique($array, SORT_REGULAR);
        if (count($object->getMenuBurgers()) != count($notDoub)) {
            $context->buildViolation("Vous avez ajouter deux burgers identiques")
            ->addViolation();
        }
    }
}