<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserServicesService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\UserServices\UserServices' shared autowired service.
     *
     * @return \App\UserServices\UserServices
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->services['App\\UserServices\\UserServices'] = new \App\UserServices\UserServices();
    }
}
