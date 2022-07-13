<?php

namespace App\Security\Voter;

use App\Entity\Commande;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CommandeVoter extends Voter
{
    public const EDIT = 'COMMANDE_EDIT';
    public const CREATE = 'COMMANDE_CREATE';
    public const READ = 'COMMANDE_READ';
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $commande): bool
    {
        //dd($commande instanceof Commande);
        //dd(in_array($attribute, ['COMMANDE_EDIT', 'COMMANDE_CREATE']));
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CREATE, self::EDIT, self::READ])
            && $commande instanceof Commande;
    }

    protected function voteOnAttribute(string $attribute, $commande, TokenInterface $token): bool
    {
       // dd($attribute);
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        //if(null=== $numeroCommande->getUsers()) return false;
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                if ( $this->security->isGranted(Role::GESTIONNAIRE) ) { return true; } 
                // logic to determine if the user can EDIT
                // return true or false
                break;
            case self::CREATE:
                //dd('ok');
                if ( $this->security->isGranted(Role::CLIENT) ) { return true; } 
                // logic to determine if the user can VIEW
                // return true or false
                break;
            case self::CREATE:
                break;
        }

        return false;
    }
}