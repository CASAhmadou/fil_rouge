<?php
namespace App\DataPersister;

use App\Entity\Menu;
use App\Entity\Boisson;
use App\Entity\Produit;
use App\Service\Validation;
use App\Service\UploadImage;
use App\Service\ValidationMenu;
use App\Service\ICalculPrixMenu;
use App\Encoder\MultipartDecoder;
use App\Service\CalculPrixMenuService;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Burger;
use Symfony\Component\Validator\Context\ExecutionContext;

class ProduitDataPersister implements DataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    private MultipartDecoder $multipartDecoder;
    private CalculPrixMenuService $calculPrixMenu;
    private UploadImage $uploadImage; 

    public function __construct(EntityManagerInterface $entityManager,
    UploadImage $uploadImage, CalculPrixMenuService $calculPrixMenu)
    {
        $this->uploadImage = $uploadImage;
        $this->entityManager = $entityManager;
        $this->calculPrixMenu = $calculPrixMenu;
    }
    public function supports($data): bool
    {
        if($data instanceof Burger){
            
        }
       if ($data instanceof Menu) {
        # code...
       }
       
        return $data instanceof Produit;

    }
    
    /**
    * @param Produit $data
    */
    
    public function persist($data)
    {
        if($data->getFile()){
            $this->valid;

            // $data->setFile($this->uploadImage->encode());
            // $image = $this->uploadImage->encode();
            //autre methode
           // dd($data->getFile());
            $image = stream_get_contents(fopen($data->getFile()->getRealPath(),"rb")); 
            
            $data->setImage($image);
        }

        if($data instanceof Burger){

        }
        if($data instanceof Burger){
        }
        
        
        if($data instanceof Menu){

            $prix = $this->calculPrixMenu->calculPrixMenu($data);
            
            $data->setPrix($prix);
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    public function remove($data)
    {
        $data->setEtat("archive");
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
