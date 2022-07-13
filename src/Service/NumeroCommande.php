<?php
namespace App\Service;


class NumeroCommande
{
    public function generer(){
        //$
        $today = date("Ymd");
        $rand = sprintf("N°", "%04d", rand(0,9999));
        $unique = $today . $rand;
        return $unique;
    }

}