<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_ZBzfrbVService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.zBzfrbV' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.zBzfrbV'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'groupe' => ['privates', 'App\\Repository\\GroupeRepository', 'getGroupeRepositoryService', true],
            'mailer' => ['services', 'swiftmailer.mailer.default', 'getSwiftmailer_Mailer_DefaultService', true],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'niveau' => ['privates', 'App\\Repository\\NiveauRepository', 'getNiveauRepositoryService', true],
            'promo' => ['privates', 'App\\Repository\\PromoBriefRepository', 'getPromoBriefRepositoryService', true],
            'ref' => ['privates', 'App\\Repository\\ReferentielRepository', 'getReferentielRepositoryService', true],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'tag' => ['privates', 'App\\Repository\\TagRepository', 'getTagRepositoryService', true],
            'validator' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'groupe' => 'App\\Repository\\GroupeRepository',
            'mailer' => '?',
            'manager' => '?',
            'niveau' => 'App\\Repository\\NiveauRepository',
            'promo' => 'App\\Repository\\PromoBriefRepository',
            'ref' => 'App\\Repository\\ReferentielRepository',
            'serializer' => '?',
            'tag' => 'App\\Repository\\TagRepository',
            'validator' => '?',
        ]);
    }
}
