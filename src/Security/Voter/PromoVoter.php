<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PromoVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST_EDIT', 'POST_VIEW'])
            && $subject instanceof \App\Entity\BlogPost;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'ADD':
                if ($user -> getRoles()[0] === "ROLE_ADMIN" || $user -> getRoles()[0] === "ROLE_FORMATEUR") {
                    return true;
                }
                return false;
                break;
            case 'EDIT':
                if ($user -> getRoles()[0] === "ROLE_ADMIN" || $user -> getRoles()[0] === "ROLE_FORMATEUR") {
                    return true;
                }
                return false;
                break;
            case 'DELETE':
                return $subject -> getUser() === $user;
                break;
            case 'VIEW':
                return $user -> getRoles()[0] === "ROLE_ADMIN" || $user -> getRoles()[0] === "ROLE_CM"  || $user -> getRoles()[0] === "ROLE_FORMATEUR";
                break;
        }

        return false;
    }
}
