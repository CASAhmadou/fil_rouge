<?php
namespace App\DataPersister;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Service\MontantCommande;
use App\Service\NumeroCommande;

final class CommandeDataPersister implements DataPersisterInterface
{
    public function __construct(private EntityManagerInterface $entityManager,
     private MontantCommande $montantCommande, private NumeroCommande $numCommande){

    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande;
    }

    public function persist($data, array $context = [])
    {
        
        $data->setNumeroCommande($this->numCommande->generer());
        $montant= $this->montantCommande->prixTotalCommande($data);

        $data->setMontantCommande($montant);
       
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}