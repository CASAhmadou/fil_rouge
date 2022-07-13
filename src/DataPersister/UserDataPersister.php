<?php
namespace App\DataPersister;

use App\Entity\User;
use App\Entity\Client;
use Symfony\Component\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;
    public function __construct(UserPasswordHasherInterface $passwordHasher,
    EntityManagerInterface $entityManager)
    {
        $this->passwordHasher= $passwordHasher;
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
       // dd($data);
        return $data instanceof User;
    }
    /**
    * @param User $data
    */
    public function persist($data, array $context = [])
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
        $data, $data->getPassword());
        $data->setPassword($hashedPassword);
        $data->eraseCredentials();
        $data->setToken($this->generateToken());

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
  
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}
