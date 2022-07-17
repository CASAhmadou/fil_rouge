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


















// public function genererNumero(CommandeRepository $repo){

//     $id = $repo->findOneBy([],['id'=>'desc'])->getId();
//     $id++;
//     $numero = "COM-00".$id;

//     return $numero;

// }