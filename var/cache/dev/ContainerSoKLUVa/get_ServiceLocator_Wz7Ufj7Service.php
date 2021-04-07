<?php

namespace ContainerSoKLUVa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Wz7Ufj7Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Wz7Ufj7' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Wz7Ufj7'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'brief' => ['privates', 'App\\Repository\\BriefRepository', 'getBriefRepositoryService', true],
            'groupe' => ['privates', 'App\\Repository\\GroupeRepository', 'getGroupeRepositoryService', true],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'promo' => ['privates', 'App\\Repository\\PromoRepository', 'getPromoRepositoryService', true],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'validator' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'brief' => 'App\\Repository\\BriefRepository',
            'groupe' => 'App\\Repository\\GroupeRepository',
            'manager' => '?',
            'promo' => 'App\\Repository\\PromoRepository',
            'serializer' => '?',
            'validator' => '?',
        ]);
    }
}