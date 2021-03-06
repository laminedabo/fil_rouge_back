<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_1p8EapZService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.1p8EapZ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.1p8EapZ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cmp_repo' => ['privates', 'App\\Repository\\CompetenceRepository', 'getCompetenceRepositoryService', true],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'validator' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'cmp_repo' => 'App\\Repository\\CompetenceRepository',
            'manager' => '?',
            'serializer' => '?',
            'validator' => '?',
        ]);
    }
}
