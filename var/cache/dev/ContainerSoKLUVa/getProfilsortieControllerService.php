<?php

namespace ContainerSoKLUVa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getProfilsortieControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\ProfilsortieController' shared autowired service.
     *
     * @return \App\Controller\ProfilsortieController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/ProfilsortieController.php';

        $container->services['App\\Controller\\ProfilsortieController'] = $instance = new \App\Controller\ProfilsortieController();

        $instance->setContainer(($container->privates['.service_locator.g9CqTPp'] ?? $container->load('get_ServiceLocator_G9CqTPpService'))->withContext('App\\Controller\\ProfilsortieController', $container));

        return $instance;
    }
}