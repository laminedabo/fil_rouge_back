<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Avd2yhlService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Avd2yhl' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Avd2yhl'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'groupe_repo' => ['privates', 'App\\Repository\\GroupeRepository', 'getGroupeRepositoryService', true],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'promo_repo' => ['privates', 'App\\Repository\\PromoRepository', 'getPromoRepositoryService', true],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'validator' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'groupe_repo' => 'App\\Repository\\GroupeRepository',
            'manager' => '?',
            'promo_repo' => 'App\\Repository\\PromoRepository',
            'serializer' => '?',
            'validator' => '?',
        ]);
    }
}
