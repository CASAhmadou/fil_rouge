<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Gestionnaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher){
      
        $this->passwordHasher = $passwordHasher ;
    }

    public function load(ObjectManager $manager): void
    {
        $user=new Client();
        $user->setLogin('client@gmail.com');
        $user->setNom('Kasse');
        $user->setPrenom('Dieynaba');
        $user->setAdresse("mbao");
        $user->setTelephone("762208564");
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user,
        'cas'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_CLIENT']);

        $user1=new Gestionnaire();
        $user1->setLogin('gestionnaire@gmail.com');
        $user1->setNom('Sakho');
        $user1->setPrenom('Cheikhna');
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user1,
        'cas'
        );
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_GESTIONNAIRE']);
        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
    }
}
