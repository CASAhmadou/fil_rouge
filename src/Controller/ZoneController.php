<?php

namespace App\Controller;

use App\Entity\Quartier;
use App\Entity\Zone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Json;

class ZoneController extends AbstractController
{
    #[Route('/api/zones')]
    public function __invoke(Request $request,EntityManagerInterface $manager)
    {
        $zone = new Zone();
        $data = $request->getContent();
        $data = json_decode($data,true);
        //dd($data["quartiers"]);
        $quartiers = $data["quartiers"];

        $zone->setLibelle($data["libelle"]);
        $zone->setPrix($data["prix"]);
        $manager->persist($zone);
    
        foreach ($quartiers as $qrt) {
            $quartier = new Quartier();
            $quartier->setZone($zone);
            $quartier->setLibelle($qrt);
            $manager->persist($quartier);
        }
        $manager->flush();
        return $this->json(["succes"=>"la zone a bien été crée","status"=>200],200);
    }
}