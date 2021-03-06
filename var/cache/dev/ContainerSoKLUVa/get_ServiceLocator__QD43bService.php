<?php

namespace ContainerSoKLUVa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator__QD43bService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator..q_d43b' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator..q_d43b'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'Groupetag' => ['privates', 'App\\Repository\\GroupetagRepository', 'getGroupetagRepositoryService', true],
        ], [
            'Groupetag' => 'App\\Repository\\GroupetagRepository',
        ]);
    }
}
