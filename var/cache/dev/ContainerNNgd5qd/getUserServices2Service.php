<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserServices2Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Services\UserServices' shared autowired service.
     *
     * @return \App\Services\UserServices
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Services/UserServices.php';

        return $container->privates['App\\Services\\UserServices'] = new \App\Services\UserServices();
    }
}
