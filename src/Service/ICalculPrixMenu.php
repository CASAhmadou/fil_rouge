<?php
namespace App\Service;

use App\Entity\Menu;
use PhpParser\Node\Expr\AssignOp\Mod;

interface ICalculPrixMenu {
    public function calculPrixMenu(Menu $menu): float;
}