<?php
namespace App\Service;


class NumeroCommande
{
    public function generer(){
        //$
        $today = date("Ymd");
        $rand = sprintf("%04d", rand(0,9999));
        $unique = "N°" . $today . $rand;
        return $unique;
    }

}