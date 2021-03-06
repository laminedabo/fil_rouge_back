<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class BriefVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'VIEW','VIEW_APPRENANT'])
            && $subject instanceof \App\Entity\Brief;
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
            case 'VIEW':
                return $user -> getRoles()[0] === "ROLE_ADMIN" || $user -> getRoles()[0] === "ROLE_FORMATEUR";
                break;
            case 'VIEW_APPRENANT':
                return $user -> getRoles()[0] === "ROLE_APPRENANT" || $user -> getRoles()[0] === "ROLE_FORMATEUR";
                break;
        }

        return false;
    }
}
