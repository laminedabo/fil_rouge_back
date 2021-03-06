<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_LMeZ5AJService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.LMeZ5AJ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.LMeZ5AJ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'promo_repo' => ['privates', 'App\\Repository\\PromoRepository', 'getPromoRepositoryService', true],
        ], [
            'promo_repo' => 'App\\Repository\\PromoRepository',
        ]);
    }
}
