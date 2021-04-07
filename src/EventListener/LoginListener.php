<?php

namespace  App\EventListener;

use App\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;


class LoginListener{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this -> em = $em;
    }

    public function onSecurityAuthenticationSuccess(AuthenticationEvent $event){ 
        if ($user = $event -> getAuthenticationToken() -> getUser()) {
            $user -> setLastLogin(new \Datetime());
            $this -> em -> persist($user);
            $this -> em -> flush();
        }     
    }
}