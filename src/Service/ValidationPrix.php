<?php

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\PortionFrite;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ValidationPrix
{
    public function validePrix($object, ExecutionContextInterface $context, $payload)
    {
        $value = true;
        $produit=$object->getPrix();
        if($produit<=0) {
            $value = false;     
        }
        if ($value == false) {
            $context
                ->buildViolation("Prix doit etre positive")
                ->addViolation();
        }
    }
}