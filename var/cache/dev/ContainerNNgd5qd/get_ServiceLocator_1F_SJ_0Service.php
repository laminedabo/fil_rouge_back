<?php

namespace ContainerNNgd5qd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_1F_SJ_0Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.1F.SJ.0' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.1F.SJ.0'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'apprenant_repo' => ['privates', 'App\\Repository\\ApprenantRepository', 'getApprenantRepositoryService', true],
            'mailer' => ['services', 'swiftmailer.mailer.default', 'getSwiftmailer_Mailer_DefaultService', true],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'profil_repo' => ['privates', 'App\\Repository\\ProfilRepository', 'getProfilRepositoryService', true],
            'promo_repo' => ['privates', 'App\\Repository\\PromoRepository', 'getPromoRepositoryService', true],
            'ref_repo' => ['privates', 'App\\Repository\\ReferentielRepository', 'getReferentielRepositoryService', true],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'validator' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'apprenant_repo' => 'App\\Repository\\ApprenantRepository',
            'mailer' => '?',
            'manager' => '?',
            'profil_repo' => 'App\\Repository\\ProfilRepository',
            'promo_repo' => 'App\\Repository\\PromoRepository',
            'ref_repo' => 'App\\Repository\\ReferentielRepository',
            'serializer' => '?',
            'validator' => '?',
        ]);
    }
}
