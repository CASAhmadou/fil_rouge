<?php

namespace App\EventSubscriber;

use App\Entity\Boisson;
use App\Entity\Burger;
use App\Entity\Commande;
use App\Entity\Menu;
use App\Entity\PortionFrite;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private ?TokenInterface $token;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage->getToken();
    }
    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }
    private function getUser()
    {
        //dd($this->token);
        if (null === $token = $this->token) {
            return null;
        }
        if (!is_object($user = $token->getUser())) {
            return null;
        }
        return $user;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        if ($args->getObject() instanceof Burger) {
            $args->getObject()->setGestionnaire($this->getUser());
        }
        if ($args->getObject() instanceof Boisson) {
            $args->getObject()->setGestionnaire($this->getUser());
        }
        if ($args->getObject() instanceof PortionFrite) {
            $args->getObject()->setGestionnaire($this->getUser());
        }
        if ($args->getObject() instanceof Menu) {
            $args->getObject()->setGestionnaire($this->getUser());
        }
        if ($args->getObject() instanceof Commande) {
            $args->getObject()->setClient($this->getUser());
        }
    }
}
