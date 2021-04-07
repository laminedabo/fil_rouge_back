<?php

namespace App\Security\Voter;

use App\Entity\Competence;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CompetenceVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'VIEW','DELETE'])
            && $subject instanceof \App\Entity\Competence;
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
            case 'EDIT':
                if ($user -> getRoles()[0] === "ROLE_ADMIN") {
                    return true;
                }
                return false;
                break;
            case 'DELETE':
                if ($user -> getRoles()[0] === "ROLE_ADMIN") {
                    return true;
                }
                return false;
                break;
            case 'VIEW':
                return $user -> getRoles()[0] === "ROLE_ADMIN" || $user -> getRoles()[0] === "ROLE_CM" || $user -> getRoles()[0] === "ROLE_FORMATEUR";
                break;
        }

        return false;
    }
}
