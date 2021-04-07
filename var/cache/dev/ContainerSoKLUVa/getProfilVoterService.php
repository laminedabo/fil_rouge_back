<?php

namespace ContainerSoKLUVa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getProfilVoterService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'debug.security.voter.App\Security\Voter\ProfilVoter' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\Voter\TraceableVoter
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-core/Authorization/Voter/VoterInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-core/Authorization/Voter/TraceableVoter.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-core/Authorization/Voter/Voter.php';
        include_once \dirname(__DIR__, 4).'/src/Security/Voter/ProfilVoter.php';

        return $container->privates['debug.security.voter.App\\Security\\Voter\\ProfilVoter'] = new \Symfony\Component\Security\Core\Authorization\Voter\TraceableVoter(new \App\Security\Voter\ProfilVoter(), ($container->services['event_dispatcher'] ?? $container->getEventDispatcherService()));
    }
}
