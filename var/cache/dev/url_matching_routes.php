<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/admins' => [[['_route' => 'admin_liste', '_controller' => 'App\\Controller\\AdminController::getAdmin', '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_admins'], null, ['GET' => 0], null, false, false, null]],
        '/api/apprenants' => [[['_route' => 'apprenant_liste', '_controller' => 'App\\Controller\\ApprenantController::getApprenant', '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_apprenants'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/apprenants' => [
            [['_route' => 'app_apprenant_addapprenant', '__controller' => 'App\\Controller\\ApprenantController::addApprenant', '__api_resource_class' => 'Apprenant', '__api_collection_operation_name' => 'add_apprenant', '_controller' => 'App\\Controller\\ApprenantController::addApprenant'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_apprenants_add_apprenant_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_collection_operation_name' => 'add_apprenant'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_apprenants_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/formateur/briefs/brouillons' => [[['_route' => 'briefs_brouillon', '_controller' => 'App\\Controller\\BriefController::briefs_brouillon', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'briefs_brouillon'], null, ['GET' => 0], null, false, false, null]],
        '/api/formateur/briefs/valides' => [[['_route' => 'briefs_valide', '_controller' => 'App\\Controller\\BriefController::briefs_valide', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'briefs_valide'], null, ['GET' => 0], null, false, false, null]],
        '/api/formateur/briefs' => [
            [['_route' => 'app_brief_addbrief', '__controller' => 'App\\Controller\\BriefController::addBrief', '__api_resource_class' => 'App\\Entity\\Brief', '__api_collection_operation_name' => 'add_briefs', '_controller' => 'App\\Controller\\BriefController::addBrief'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_briefs_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_briefs_add_briefs_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'add_briefs'], null, ['POST' => 0], null, false, false, null],
        ],
        '/brief' => [[['_route' => 'brief', '_controller' => 'App\\Controller\\BriefController::UpdateBrief'], null, null, null, false, false, null]],
        '/commentaire/general' => [[['_route' => 'commentaire_general', '_controller' => 'App\\Controller\\CommentaireGeneralController::index'], null, null, null, false, false, null]],
        '/api/admin/competences' => [
            [['_route' => 'app_competence_addcompetence', '__controller' => 'App\\Controller\\CompetenceController::addCompetence', '__api_resource_class' => 'App\\Entity\\Competence', '__api_collection_operation_name' => 'add_competence', '_controller' => 'App\\Controller\\CompetenceController::addCompetence'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_competences_add_competence_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_collection_operation_name' => 'add_competence'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_competences_show_competence_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_collection_operation_name' => 'show_competence'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/Competences' => [[['_route' => 'app_competence_showcompetence', '__controller' => 'App\\Controller\\CompetenceController::showCompetence', '__api_resource_class' => 'App\\Entity\\Competence', '__api_collection_operation_name' => 'show_Competence', '_controller' => 'App\\Controller\\CompetenceController::showCompetence'], null, ['GET' => 0], null, false, false, null]],
        '/api/formateurs' => [[['_route' => 'formateur_liste', '_controller' => 'App\\Controller\\FormateurController::getFormateur', '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_formateurs'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/formateurs' => [
            [['_route' => 'app_formateur_addformateur', '__controller' => 'App\\Controller\\FormateurController::addFormateur', '__api_resource_class' => 'Formateur', '__api_collection_operation_name' => 'add_formateur', '_controller' => 'App\\Controller\\FormateurController::addFormateur'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_formateurs_add_formateur_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_collection_operation_name' => 'add_formateur'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_formateurs_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/formateur' => [[['_route' => 'formateur', '_controller' => 'App\\Controller\\FormateurController::index'], null, null, null, false, false, null]],
        '/api/admin/groupes' => [
            [['_route' => 'app_groupe_addgroupe', '__controller' => 'App\\Controller\\GroupeController::addGroupe', '__api_resource_class' => 'App\\Entity\\Groupe', '__api_collection_operation_name' => 'add_groupe', '_controller' => 'App\\Controller\\GroupeController::addGroupe'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_groupes_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupes_add_groupe_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_collection_operation_name' => 'add_groupe'], null, ['POST' => 0], null, false, false, null],
        ],
        '/groupe' => [[['_route' => 'groupe', '_controller' => 'App\\Controller\\GroupeController::index'], null, null, null, false, false, null]],
        '/api/admin/groupecompetences' => [
            [['_route' => 'app_groupecompetence_addgroupecompetence', '__controller' => 'App\\Controller\\GroupecompetenceController::addGroupecompetence', '__api_resource_class' => 'App\\Entity\\Groupecompetence', '__api_collection_operation_name' => 'add_groupecompetence', '_controller' => 'App\\Controller\\GroupecompetenceController::addGroupecompetence'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_groupecompetences_add_groupecompetence_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_collection_operation_name' => 'add_groupecompetence'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_groupecompetences_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/groupetag' => [[['_route' => 'groupetag', '_controller' => 'App\\Controller\\GroupetagController::index'], null, null, null, false, false, null]],
        '/api/admin/groupetags' => [
            [['_route' => 'app_groupetag_addgroupetag', '__controller' => 'App\\Controller\\GroupetagController::addGroupetag', '__api_resource_class' => 'App\\Entity\\Groupetag', '__api_collection_operation_name' => 'add_groupetags', '_controller' => 'App\\Controller\\GroupetagController::addGroupetag'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'app_groupetag_showgroupetag', '__controller' => 'App\\Controller\\GroupetagController::showGroupetag', '__api_resource_class' => 'App\\Entity\\Groupetag', '__api_collection_operation_name' => 'show_groupetagss', '_controller' => 'App\\Controller\\GroupetagController::showGroupetag'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupetags_add_groupetags_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_collection_operation_name' => 'add_groupetags'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_groupetags_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupetags_show_groupetags_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_collection_operation_name' => 'show_groupetags'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/promos' => [
            [['_route' => 'app_promo_addpromo', '__controller' => 'App\\Controller\\PromoController::addPromo', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'add_promo', '_controller' => 'App\\Controller\\PromoController::addPromo'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_promos_add_promo_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_collection_operation_name' => 'add_promo'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_promos_show_promo_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_collection_operation_name' => 'show_promo'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/promos/principal' => [[['_route' => 'app_promo_promo_gp_principal', '__controller' => 'App\\Controller\\PromoController::promo_gp_principal', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'promo_gprincipal', '_controller' => 'App\\Controller\\PromoController::promo_gp_principal'], null, ['GET' => 0], null, false, false, null]],
        '/promo' => [[['_route' => 'promo', '_controller' => 'App\\Controller\\PromoController::index'], null, null, null, false, false, null]],
        '/api/admin/referentiels' => [
            [['_route' => 'app_referentiel_addreferentiel', '__controller' => 'App\\Controller\\ReferentielController::addReferentiel', '__api_resource_class' => 'App\\Entity\\Referentiel', '__api_collection_operation_name' => 'add_referentiel', '_controller' => 'App\\Controller\\ReferentielController::addReferentiel'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_referentiels_add_referentiel_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_collection_operation_name' => 'add_referentiel'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_referentiels_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/referentiel' => [[['_route' => 'referentiel', '_controller' => 'App\\Controller\\ReferentielController::index'], null, null, null, false, false, null]],
        '/api/admin/users' => [
            [['_route' => 'app_user_adduser', '__controller' => 'App\\Controller\\UserController::addUser', '__api_resource_class' => 'App\\Entity\\User', '__api_collection_operation_name' => 'add_user', '_controller' => 'App\\Controller\\UserController::addUser'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_users_add_user_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'add_user'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_users_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/tags' => [
            [['_route' => 'api_tags_add_groupetags_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_collection_operation_name' => 'add_groupetags'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_tags_show_tags_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_collection_operation_name' => 'show_tags'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/profils' => [
            [['_route' => 'api_profils_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'post'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_profils_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/livrables' => [[['_route' => 'api_livrable_partiels_collection_app_livrables_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrablePartiel', '_api_collection_operation_name' => 'collection_app_livrables'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/niveaux' => [[['_route' => 'api_niveaux_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/profilsorties' => [
            [['_route' => 'api_profilsorties_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_collection_operation_name' => 'post'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_profilsorties_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_collection_operation_name' => 'get'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api(?'
                    .'|/(?'
                        .'|a(?'
                            .'|dmin(?'
                                .'|s/([^/]++)(*:74)'
                                .'|/(?'
                                    .'|competences/([^/]++)(*:105)'
                                    .'|groupe(?'
                                        .'|s/([^/]++)(?'
                                            .'|(*:135)'
                                            .'|/apprenants/([^/]++)(*:163)'
                                        .')'
                                        .'|competences/([^/]++)(*:192)'
                                        .'|tags/([^/]++)(*:213)'
                                    .')'
                                    .'|promos/([^/]++)(?'
                                        .'|/(?'
                                            .'|pr(?'
                                                .'|ofilsorties(?'
                                                    .'|(*:263)'
                                                    .'|/([^/]++)(*:280)'
                                                .')'
                                                .'|incipal(*:296)'
                                            .')'
                                            .'|apprenants(?'
                                                .'|/attente(*:326)'
                                                .'|(*:334)'
                                            .')'
                                            .'|formateurs(*:353)'
                                            .'|groupes(*:368)'
                                        .')'
                                        .'|(*:377)'
                                    .')'
                                    .'|referentiels/([^/]++)(*:407)'
                                    .'|users/(?'
                                        .'|([^/]++)(*:432)'
                                        .'|count(*:445)'
                                        .'|search(*:459)'
                                    .')'
                                .')'
                            .')'
                            .'|pprenants/(?'
                                .'|([^/]++)(*:491)'
                                .'|promos/([^/]++)/briefs(?'
                                    .'|(*:524)'
                                    .'|/([^/]++)(*:541)'
                                .')'
                                .'|([^/]++)/groupe/([^/]++)/livrables(*:584)'
                            .')'
                        .')'
                        .'|formateur(?'
                            .'|/(?'
                                .'|promo(?'
                                    .'|s/([^/]++)/groupes/([^/]++)/briefs(*:652)'
                                    .'|/([^/]++)/brief/([^/]++)(?'
                                        .'|/assignation(*:699)'
                                        .'|(*:707)'
                                    .')'
                                .')'
                                .'|briefs/([^/]++)(*:732)'
                            .')'
                            .'|s/(?'
                                .'|promos/([^/]++)/briefs(?'
                                    .'|/([^/]++)(*:780)'
                                    .'|(*:788)'
                                .')'
                                .'|([^/]++)(*:805)'
                            .')'
                        .')'
                        .'|users/promo/([^/]++)/apprenant/([^/]++)/chats(?'
                            .'|(*:863)'
                        .')'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:901)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:932)'
                        .'|c(?'
                            .'|o(?'
                                .'|ntexts/(.+)(?:\\.([^/]++))?(*:974)'
                                .'|mmentaire_generals/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1029)'
                                .')'
                            .')'
                            .'|_ms(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1064)'
                                .')'
                                .'|(?:/([^/\\.]++)(?:\\.([^/]++))?)?(*:1105)'
                            .')'
                        .')'
                        .'|formateur(?'
                            .'|/(?'
                                .'|promo(?'
                                    .'|s/([^/]++)/groupes/(\\d+)/briefs(*:1171)'
                                    .'|/([^/]++)/brief/([^/]++)(*:1204)'
                                .')'
                                .'|briefs(?'
                                    .'|/(?'
                                        .'|brouillons(*:1237)'
                                        .'|valides(*:1253)'
                                    .')'
                                    .'|(?:/([^/]++))?(*:1277)'
                                    .'|/([^/]++)(*:1295)'
                                .')'
                            .')'
                            .'|s/(?'
                                .'|promo(?'
                                    .'|s/(?'
                                        .'|([^/]++)/briefs/(\\d+)(*:1345)'
                                        .'|(\\d+)/briefs(*:1366)'
                                    .')'
                                    .'|/([^/]++)/brief/([^/]++)/assignation(*:1412)'
                                .')'
                                .'|(\\d+)(*:1427)'
                                .'|promo(?'
                                    .'|/([^/]++)/referentiel/([^/]++)/(?'
                                        .'|competences(?'
                                            .'|(*:1492)'
                                            .'|/([^/]++)(*:1510)'
                                        .')'
                                        .'|statistiques/competences(*:1544)'
                                    .')'
                                    .'|_referentiel/competences/([^/]++)(*:1587)'
                                .')'
                            .')'
                        .')'
                        .'|a(?'
                            .'|p(?'
                                .'|prenant(?'
                                    .'|s/(?'
                                        .'|promos/(?'
                                            .'|([^/]++)/briefs/(\\d+)(*:1653)'
                                            .'|(\\d+)/briefs(*:1674)'
                                        .')'
                                        .'|(\\d+)(*:1689)'
                                        .'|([^/]++)/groupe/([^/]++)/livrables(*:1732)'
                                    .')'
                                    .'|/([^/]++)/promo/([^/]++)/referentiel/([^/]++)/statistiques/briefs(*:1807)'
                                .')'
                                .'|i/apprenant/([^/]++)/promo/([^/]++)/referentiel/([^/]++)/competences(*:1885)'
                            .')'
                            .'|dmin(?'
                                .'|/(?'
                                    .'|formateurs(?'
                                        .'|(?:/([^/]++))?(*:1933)'
                                        .'|/([^/]++)(?'
                                            .'|(*:1954)'
                                        .')'
                                    .')'
                                    .'|users/(\\d+)(?'
                                        .'|(*:1979)'
                                    .')'
                                    .'|groupe(?'
                                        .'|tags/(?'
                                            .'|tags(*:2010)'
                                            .'|([^/]++)(?'
                                                .'|(*:2030)'
                                                .'|/tags(?:\\.([^/]++))?(*:2059)'
                                            .')'
                                        .')'
                                        .'|s/(?'
                                            .'|apprenants(*:2085)'
                                            .'|([^/]++)(?'
                                                .'|(*:2105)'
                                                .'|/apprenants/([^/]++)(*:2134)'
                                            .')'
                                            .'|groupes/([^/]++)/apprenants(?:\\.([^/]++))?(*:2186)'
                                        .')'
                                        .'|competences/(?'
                                            .'|competences(*:2222)'
                                            .'|([^/]++)(?'
                                                .'|(*:2242)'
                                                .'|/(?'
                                                    .'|user(?:\\.([^/]++))?(*:2274)'
                                                    .'|competences(?'
                                                        .'|(?:\\.([^/]++))?(*:2312)'
                                                        .'|/([^/]++)/(?'
                                                            .'|groupecompetences(?'
                                                                .'|(?:\\.([^/]++))?(*:2369)'
                                                                .'|/([^/]++)/user(?:\\.([^/]++))?(*:2407)'
                                                            .')'
                                                            .'|niveaux(?:\\.([^/]++))?(*:2439)'
                                                        .')'
                                                    .')'
                                                .')'
                                            .')'
                                        .')'
                                    .')'
                                    .'|pro(?'
                                        .'|mos/(?'
                                            .'|principal(*:2476)'
                                            .'|([^/]++)(?'
                                                .'|(*:2496)'
                                                .'|/(?'
                                                    .'|apprenants(*:2519)'
                                                    .'|formateurs(*:2538)'
                                                    .'|groupes(?'
                                                        .'|(*:2557)'
                                                        .'|(?:\\.([^/]++))?(*:2581)'
                                                        .'|/([^/]++)/apprenants(?:\\.([^/]++))?(*:2625)'
                                                    .')'
                                                    .'|referentiel(?'
                                                        .'|(?:\\.([^/]++))?(*:2664)'
                                                        .'|/competences(?'
                                                            .'|(?:\\.([^/]++))?(*:2703)'
                                                            .'|/([^/]++)/(?'
                                                                .'|groupecompetences(?'
                                                                    .'|(?:\\.([^/]++))?(*:2760)'
                                                                    .'|/([^/]++)/(?'
                                                                        .'|user(?:\\.([^/]++))?(*:2801)'
                                                                        .'|competences(?'
                                                                            .'|(?:\\.([^/]++))?(*:2839)'
                                                                            .'|/([^/]++)/niveaux(?:\\.([^/]++))?(*:2880)'
                                                                        .')'
                                                                    .')'
                                                                .')'
                                                                .'|niveaux(?:\\.([^/]++))?(*:2914)'
                                                            .')'
                                                        .')'
                                                    .')'
                                                    .'|profilsorties(?'
                                                        .'|(*:2942)'
                                                        .'|/([^/]++)(*:2960)'
                                                    .')'
                                                .')'
                                            .')'
                                        .')'
                                        .'|fils(?'
                                            .'|/([^/]++)(?'
                                                .'|(*:2992)'
                                            .')'
                                            .'|orties/([^/]++)(?'
                                                .'|(*:3020)'
                                            .')'
                                        .')'
                                    .')'
                                    .'|referentiels/(?'
                                        .'|groupecompetences(*:3065)'
                                        .'|([^/]++)(?'
                                            .'|(*:3085)'
                                            .'|/competences(*:3106)'
                                            .'|(*:3115)'
                                        .')'
                                        .'|referentiels/([^/]++)/competences(?'
                                            .'|(?:\\.([^/]++))?(*:3176)'
                                            .'|/([^/]++)/groupecompetences(?:\\.([^/]++))?(*:3227)'
                                        .')'
                                    .')'
                                    .'|competences/([^/]++)(?'
                                        .'|(*:3261)'
                                        .'|/(?'
                                            .'|groupecompetences(?'
                                                .'|(?:\\.([^/]++))?(*:3309)'
                                                .'|/([^/]++)/(?'
                                                    .'|user(?:\\.([^/]++))?(*:3350)'
                                                    .'|competences(?'
                                                        .'|(?:\\.([^/]++))?(*:3388)'
                                                        .'|/([^/]++)/niveaux(?:\\.([^/]++))?(*:3429)'
                                                    .')'
                                                .')'
                                            .')'
                                            .'|niveaux(?:\\.([^/]++))?(*:3463)'
                                        .')'
                                    .')'
                                    .'|tags/([^/]++)(?'
                                        .'|(*:3490)'
                                    .')'
                                    .'|apprenants(?'
                                        .'|(?:/([^/]++))?(*:3527)'
                                        .'|/([^/]++)(?'
                                            .'|(*:3548)'
                                        .')'
                                    .')'
                                .')'
                                .'|s/(\\d+)(*:3567)'
                            .')'
                        .')'
                        .'|pro(?'
                            .'|mo_briefs(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:3614)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:3653)'
                                .')'
                            .')'
                            .'|fils(?'
                                .'|/([^/]++)/users(?:\\.([^/]++))?(*:3701)'
                                .'|orties/([^/]++)/apprenants(?:\\.([^/]++))?(*:3751)'
                            .')'
                        .')'
                        .'|ressources(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:3793)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:3832)'
                            .')'
                        .')'
                        .'|livrable(?'
                            .'|_(?'
                                .'|attendus(?'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:3887)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:3926)'
                                    .')'
                                .')'
                                .'|partiels/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:3974)'
                                .')'
                            .')'
                            .'|s(?'
                                .'|(?:\\.([^/]++))?(*:4004)'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:4042)'
                                .')'
                            .')'
                        .')'
                        .'|users/promo/([^/]++)/apprenant/([^/]++)/chats(?'
                            .'|(*:4102)'
                        .')'
                        .'|niveaux/([^/\\.]++)(?:\\.([^/]++))?(?'
                            .'|(*:4148)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        74 => [[['_route' => 'admin_find', '_controller' => 'App\\Controller\\AdminController::getAdminById', '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_admin'], ['id'], ['GET' => 0], null, false, true, null]],
        105 => [[['_route' => 'app_competence_updatecompetence', '__controller' => 'App\\Controller\\CompetenceController::updateCompetence', '__api_resource_class' => 'App\\Entity\\Competence', '__api_collection_operation_name' => 'update_competence', '_controller' => 'App\\Controller\\CompetenceController::updateCompetence'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        135 => [[['_route' => 'app_groupe_updategroupe', '__controller' => 'App\\Controller\\GroupeController::updateGroupe', '__api_resource_class' => 'App\\Entity\\Groupe', '__api_collection_operation_name' => 'update_groupe', '_controller' => 'App\\Controller\\GroupeController::updateGroupe'], ['id'], ['PUT' => 0], null, false, true, null]],
        163 => [[['_route' => 'app_groupe_deleteapprenant', '__controller' => 'App\\Controller\\GroupeController::deleteApprenant', '__api_resource_class' => 'App\\Entity\\Groupe', '__api_item_operation_name' => 'delete_apprenant', '_controller' => 'App\\Controller\\GroupeController::deleteApprenant'], ['id', 'ida'], ['DELETE' => 0], null, false, true, null]],
        192 => [[['_route' => 'app_groupecompetence_updategroupecompetence', '__controller' => 'App\\Controller\\GroupecompetenceController::updateGroupecompetence', '__api_resource_class' => 'App\\Entity\\Groupecompetence', '__api_collection_operation_name' => 'update_groupecompetence', '_controller' => 'App\\Controller\\GroupecompetenceController::updateGroupecompetence'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        213 => [[['_route' => 'app_groupetag_updategroupetag', '__controller' => 'App\\Controller\\GroupetagController::updateGroupetag', '__api_resource_class' => 'App\\Entity\\Groupetag', '__api_collection_operation_name' => 'update_Groupetag', '_controller' => 'App\\Controller\\GroupetagController::updateGroupetag'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        263 => [[['_route' => 'app_profilsortie_profilsortie_collection', '__controller' => 'App\\Controller\\ProfilsortieController::profilsortie_collection', '__api_resource_class' => 'Profilsortie', '__api_collection_operation_name' => 'profilsortie_promo', '_controller' => 'App\\Controller\\ProfilsortieController::profilsortie_collection'], ['id'], ['GET' => 0], null, false, false, null]],
        280 => [[['_route' => 'app_profilsortie_profilsortie_item', '__controller' => 'App\\Controller\\ProfilsortieController::profilsortie_item', '__api_resource_class' => 'Profilsortie', '__api_collection_operation_name' => 'profilsortie_item', '_controller' => 'App\\Controller\\ProfilsortieController::profilsortie_item'], ['idp', 'id'], ['GET' => 0], null, false, true, null]],
        296 => [[['_route' => 'app_promo_promo_id_gp_principal', '__controller' => 'App\\Controller\\PromoController::promo_id_gp_principal', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'promo_id_gprincipal', '_controller' => 'App\\Controller\\PromoController::promo_id_gp_principal'], ['id'], ['GET' => 0], null, false, false, null]],
        326 => [[['_route' => 'app_promo_apprenantenattente', '__controller' => 'App\\Controller\\PromoController::apprenantEnAttente', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'apprenants_attente', '_controller' => 'App\\Controller\\PromoController::apprenantEnAttente'], ['id'], ['GET' => 0], null, false, false, null]],
        334 => [[['_route' => 'app_promo_gerer_apprenant', '__controller' => 'App\\Controller\\PromoController::gerer_apprenant', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'gerer_apprenants', '_controller' => 'App\\Controller\\PromoController::gerer_apprenant'], ['id'], ['PUT' => 0], null, false, false, null]],
        353 => [[['_route' => 'app_promo_gerer_formateur', '__controller' => 'App\\Controller\\PromoController::gerer_formateur', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'gerer_formateurs', '_controller' => 'App\\Controller\\PromoController::gerer_formateur'], ['id'], ['PUT' => 0], null, false, false, null]],
        368 => [[['_route' => 'app_promo_gerer_groupe', '__controller' => 'App\\Controller\\PromoController::gerer_groupe', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'gerer_groupes', '_controller' => 'App\\Controller\\PromoController::gerer_groupe'], ['id'], ['PUT' => 0], null, false, false, null]],
        377 => [[['_route' => 'app_promo_updatepromo', '__controller' => 'App\\Controller\\PromoController::updatePromo', '__api_resource_class' => 'App\\Entity\\Promo', '__api_collection_operation_name' => 'update_promo', '_controller' => 'App\\Controller\\PromoController::updatePromo'], ['id'], ['PUT' => 0], null, false, true, null]],
        407 => [[['_route' => 'app_referentiel_updatereferentiel', '__controller' => 'App\\Controller\\ReferentielController::updateReferentiel', '__api_resource_class' => 'App\\Entity\\Referentiel', '__api_collection_operation_name' => 'update_referentiel', '_controller' => 'App\\Controller\\ReferentielController::updateReferentiel'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        432 => [[['_route' => 'app_user_updateuser', '__controller' => 'App\\Controller\\UserController::UpdateUser', '__api_resource_class' => 'App\\Entity\\User', '__api_collection_operation_name' => 'update_user', '_controller' => 'App\\Controller\\UserController::UpdateUser'], ['id'], ['POST' => 0], null, false, true, null]],
        445 => [[['_route' => 'app_user_getcount', '__controller' => 'App\\Controller\\UserController::getCount', '__api_resource_class' => 'App\\Entity\\User', '__api_collection_operation_name' => 'getCount_user', '_controller' => 'App\\Controller\\UserController::getCount'], [], ['PATCH' => 0], null, false, false, null]],
        459 => [[['_route' => 'app_user_searchterm', '__controller' => 'App\\Controller\\UserController::searchTerm', '__api_resource_class' => 'App\\Entity\\User', '__api_collection_operation_name' => 'search_user', '_controller' => 'App\\Controller\\UserController::searchTerm'], [], ['PATCH' => 0], null, false, false, null]],
        491 => [[['_route' => 'apprenant_find', '_controller' => 'App\\Controller\\ApprenantController::getApprenantById', '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'get_apprenant'], ['id'], ['GET' => 0], null, false, true, null]],
        524 => [[['_route' => 'promo_apprenant_brief', '_controller' => 'App\\Controller\\BriefController::promo_apprenant_brief', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'promo_apprenant_brief'], ['id'], ['GET' => 0], null, false, false, null]],
        541 => [[['_route' => 'apprenant_promo_brief', '_controller' => 'App\\Controller\\BriefController::apprenant_promo_brief', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'apprenant_promo_brief'], ['idp', 'idb'], ['GET' => 0], null, false, true, null]],
        584 => [[['_route' => 'app_brief_addlivrable', '__controller' => 'App\\Controller\\BriefController::AddLivrable', '__api_resource_class' => 'App\\Entity\\Brief', '__api_collection_operation_name' => 'add_livrable', '_controller' => 'App\\Controller\\BriefController::AddLivrable'], ['idapp', 'idgrp'], ['POST' => 0], null, false, false, null]],
        652 => [[['_route' => 'brief_groupe_promo', '_controller' => 'App\\Controller\\BriefController::briefs_groupe_promo', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'brief_groupe_promo'], ['idp', 'idg'], ['GET' => 0], null, false, false, null]],
        699 => [[['_route' => 'app_brief_assignationbrief', '__controller' => 'App\\Controller\\BriefController::assignationBrief', '__api_resource_class' => 'App\\Entity\\Brief', '__api_collection_operation_name' => 'assignation_briefs', '_controller' => 'App\\Controller\\BriefController::assignationBrief'], ['idpromo', 'idbrief'], ['GET' => 0], null, false, false, null]],
        707 => [[['_route' => 'app_brief_updatebrief', '__controller' => 'App\\Controller\\BriefController::UpdateBrief', '__api_resource_class' => 'App\\Entity\\Brief', '__api_collection_operation_name' => 'update_briefs', '_controller' => 'App\\Controller\\BriefController::UpdateBrief'], ['idpromo', 'idbrief'], ['PUT' => 0], null, false, true, null]],
        732 => [[['_route' => 'app_brief_dupliquebrief', '__controller' => 'App\\Controller\\BriefController::addBrief', '__api_resource_class' => 'App\\Entity\\Brief', '__api_collection_operation_name' => 'duplique_briefs', '_controller' => 'App\\Controller\\BriefController::dupliqueBrief'], ['id'], ['POST' => 0], null, false, true, null]],
        780 => [[['_route' => 'brief_promo', '_controller' => 'App\\Controller\\BriefController::brief_promo', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'brief_promo'], ['idp', 'id'], ['GET' => 0], null, false, true, null]],
        788 => [[['_route' => 'promo_id_brief', '_controller' => 'App\\Controller\\BriefController::promo_id_briefs', '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'promo_id_brief'], ['idp'], ['GET' => 0], null, false, false, null]],
        805 => [[['_route' => 'formateur_find', '_controller' => 'App\\Controller\\FormateurController::getFormateurById', '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_formateur'], ['id'], ['GET' => 0], null, false, true, null]],
        863 => [
            [['_route' => 'app_commentairegeneral_envoyercommentaire', '__controller' => 'App\\Controller\\CommentaireGeneralController::envoyerCommentaire', '__api_resource_class' => 'CommentaireGeneral', '__api_collection_operation_name' => 'add_commentaire', '_controller' => 'App\\Controller\\CommentaireGeneralController::envoyerCommentaire'], ['idp', 'ida'], ['POST' => 0], null, false, false, null],
            [['_route' => 'app_commentairegeneral_affichercommentaire', '__controller' => 'App\\Controller\\CommentaireGeneralController::afficherCommentaire', '__api_resource_class' => 'CommentaireGeneral', '__api_collection_operation_name' => 'get_commentaire', '_controller' => 'App\\Controller\\CommentaireGeneralController::afficherCommentaire'], ['idp', 'ida'], ['GET' => 0], null, false, false, null],
        ],
        901 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        932 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        974 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        1029 => [
            [['_route' => 'api_commentaire_generals_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_commentaire_generals_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_commentaire_generals_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_commentaire_generals_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        1064 => [
            [['_route' => 'api_c_ms_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\CM', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_c_ms_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\CM', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1105 => [[['_route' => 'api_c_ms_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\CM', '_api_item_operation_name' => 'get', 'id' => null], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1171 => [[['_route' => 'api_briefs_brief_groupe_promo_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'brief_groupe_promo'], ['idp', 'idg'], ['GET' => 0], null, false, false, null]],
        1204 => [[['_route' => 'api_briefs_update_briefs_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_item_operation_name' => 'update_briefs', 'id' => null], ['idpromo', 'idbrief'], ['PUT' => 0], null, false, true, null]],
        1237 => [[['_route' => 'api_briefs_briefs_brouillon_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'briefs_brouillon'], [], ['GET' => 0], null, false, false, null]],
        1253 => [[['_route' => 'api_briefs_briefs_valide_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'briefs_valide'], [], ['GET' => 0], null, false, false, null]],
        1277 => [[['_route' => 'api_briefs_duplique_briefs_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'duplique_briefs', 'id' => null], ['id'], ['POST' => 0], null, false, true, null]],
        1295 => [[['_route' => 'api_briefs_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null]],
        1345 => [[['_route' => 'api_briefs_brief_promo_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'brief_promo'], ['idp', 'id'], ['GET' => 0], null, false, true, null]],
        1366 => [[['_route' => 'api_briefs_promo_id_brief_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'promo_id_brief'], ['idp'], ['GET' => 0], null, false, false, null]],
        1412 => [[['_route' => 'api_briefs_assignation_briefs_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_item_operation_name' => 'assignation_briefs'], ['idpromo', 'idbrief'], ['PUT' => 0], null, false, false, null]],
        1427 => [[['_route' => 'api_formateurs_get_formateur_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'get_formateur'], ['id'], ['GET' => 0], null, false, true, null]],
        1492 => [
            [['_route' => 'api_statistiques_competences_GET_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_collection_operation_name' => 'GET'], ['id', 'num'], ['GET' => 0], null, false, false, null],
            [['_route' => 'api_statistiques_competences_POST_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_collection_operation_name' => 'POST'], ['id', 'num'], ['POST' => 0], null, false, false, null],
        ],
        1510 => [[['_route' => 'api_statistiques_competences_PUT_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_item_operation_name' => 'PUT'], ['var', 'num', 'id'], ['PUT' => 0], null, false, true, null]],
        1544 => [[['_route' => 'api_statistiques_competences_compet_stats_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_collection_operation_name' => 'compet_stats'], ['idPr', 'idRef'], ['GET' => 0], null, false, false, null]],
        1587 => [[['_route' => 'api_statistiques_competences_GET_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_item_operation_name' => 'GET'], ['id'], ['GET' => 0], null, false, true, null]],
        1653 => [[['_route' => 'api_briefs_apprenant_promo_brief_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'apprenant_promo_brief'], ['idp', 'idb'], ['GET' => 0], null, false, true, null]],
        1674 => [[['_route' => 'api_briefs_promo_apprenant_brief_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Brief', '_api_collection_operation_name' => 'promo_apprenant_brief'], ['id'], ['GET' => 0], null, false, false, null]],
        1689 => [[['_route' => 'api_apprenants_get_apprenant_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'get_apprenant'], ['id'], ['GET' => 0], null, false, true, null]],
        1732 => [[['_route' => 'api_livrables_add_livrable_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_collection_operation_name' => 'add_livrable', 'id' => null], ['idapp', 'idgrp'], ['POST' => 0], null, false, false, null]],
        1807 => [[['_route' => 'api_statistiques_competences_apprenant_brief_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_collection_operation_name' => 'apprenant_brief'], ['idAp', 'idPr', 'idRef'], ['GET' => 0], null, false, false, null]],
        1885 => [[['_route' => 'api_statistiques_competences_apprenant_compet_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\StatistiquesCompetences', '_api_collection_operation_name' => 'apprenant_compet'], ['idAp', 'idPr', 'idRef'], ['GET' => 0], null, false, false, null]],
        1933 => [[['_route' => 'api_formateurs_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'get', 'id' => null], ['id'], ['GET' => 0], null, false, true, null]],
        1954 => [
            [['_route' => 'api_formateurs_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'put'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        1979 => [
            [['_route' => 'api_users_update_user_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'update_user'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_users_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_users_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_users_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
        ],
        2010 => [[['_route' => 'api_groupetags_show_groupetags_tags_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_collection_operation_name' => 'show_groupetags_tags'], [], ['GET' => 0], null, false, false, null]],
        2030 => [
            [['_route' => 'api_groupetags_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_groupetags_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_groupetags_updateGroupeGroupetag_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupetag', '_api_item_operation_name' => 'updateGroupeGroupetag'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        2059 => [[['_route' => 'api_groupetags_tags_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_subresource_operation_name' => 'api_groupetags_tags_get_subresource', '_api_subresource_context' => ['property' => 'tag', 'identifiers' => [['id', 'App\\Entity\\Groupetag', true]], 'collection' => true, 'operationId' => 'api_groupetags_tags_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2085 => [[['_route' => 'api_groupes_show_apprenants_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_collection_operation_name' => 'show_apprenants'], [], ['GET' => 0], null, false, false, null]],
        2105 => [
            [['_route' => 'api_groupes_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_groupes_update_groupe_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_item_operation_name' => 'update_groupe'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        2134 => [[['_route' => 'api_groupes_delete_apprenant_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_item_operation_name' => 'delete_apprenant'], ['id', 'ida'], ['DELETE' => 0], null, false, true, null]],
        2186 => [[['_route' => 'api_groupes_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_groupes_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Groupe', true]], 'collection' => true, 'operationId' => 'api_groupes_apprenants_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2222 => [[['_route' => 'api_groupecompetences_show_groupecompetence_competence_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_collection_operation_name' => 'show_groupecompetence_competence'], [], ['GET' => 0], null, false, false, null]],
        2242 => [
            [['_route' => 'api_groupecompetences_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_groupecompetences_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_groupecompetences_update_groupecompetence_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_item_operation_name' => 'update_groupecompetence'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        2274 => [[['_route' => 'api_groupecompetences_user_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_groupecompetences_user_get_subresource', '_api_subresource_context' => ['property' => 'user', 'identifiers' => [['id', 'App\\Entity\\Groupecompetence', true]], 'collection' => false, 'operationId' => 'api_groupecompetences_user_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2312 => [[['_route' => 'api_groupecompetences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_groupecompetences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competence', 'identifiers' => [['id', 'App\\Entity\\Groupecompetence', true]], 'collection' => true, 'operationId' => 'api_groupecompetences_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2369 => [[['_route' => 'api_groupecompetences_competences_groupecompetences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_subresource_operation_name' => 'api_groupecompetences_competences_groupecompetences_get_subresource', '_api_subresource_context' => ['property' => 'groupecompetences', 'identifiers' => [['id', 'App\\Entity\\Groupecompetence', true], ['competence', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_groupecompetences_competences_groupecompetences_get_subresource']], ['id', 'competence', '_format'], ['GET' => 0], null, false, true, null]],
        2407 => [[['_route' => 'api_groupecompetences_competences_groupecompetences_user_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_groupecompetences_competences_groupecompetences_user_get_subresource', '_api_subresource_context' => ['property' => 'user', 'identifiers' => [['id', 'App\\Entity\\Groupecompetence', true], ['competence', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true]], 'collection' => false, 'operationId' => 'api_groupecompetences_competences_groupecompetences_user_get_subresource']], ['id', 'competence', 'groupecompetences', '_format'], ['GET' => 0], null, false, true, null]],
        2439 => [[['_route' => 'api_groupecompetences_competences_niveaux_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_subresource_operation_name' => 'api_groupecompetences_competences_niveaux_get_subresource', '_api_subresource_context' => ['property' => 'niveau', 'identifiers' => [['id', 'App\\Entity\\Groupecompetence', true], ['competence', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_groupecompetences_competences_niveaux_get_subresource']], ['id', 'competence', '_format'], ['GET' => 0], null, false, true, null]],
        2476 => [[['_route' => 'api_promos_promo_gprincipal_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_collection_operation_name' => 'promo_gprincipal'], [], ['GET' => 0], null, false, false, null]],
        2496 => [
            [['_route' => 'api_promos_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_promos_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_promos_update_promo_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'update_promo'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        2519 => [[['_route' => 'api_promos_gerer_apprenants_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'gerer_apprenants'], ['id'], ['PUT' => 0], null, false, false, null]],
        2538 => [[['_route' => 'api_promos_gerer_formateurs_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'gerer_formateurs'], ['id'], ['PUT' => 0], null, false, false, null]],
        2557 => [[['_route' => 'api_promos_gerer_groupes_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promo', '_api_item_operation_name' => 'gerer_groupes'], ['id'], ['PUT' => 0], null, false, false, null]],
        2581 => [[['_route' => 'api_promos_groupes_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupe', '_api_subresource_operation_name' => 'api_promos_groupes_get_subresource', '_api_subresource_context' => ['property' => 'groupes', 'identifiers' => [['id', 'App\\Entity\\Promo', true]], 'collection' => true, 'operationId' => 'api_promos_groupes_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2625 => [[['_route' => 'api_promos_groupes_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_promos_groupes_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['groupes', 'App\\Entity\\Groupe', true]], 'collection' => true, 'operationId' => 'api_promos_groupes_apprenants_get_subresource']], ['id', 'groupes', '_format'], ['GET' => 0], null, false, true, null]],
        2664 => [[['_route' => 'api_promos_referentiel_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_subresource_operation_name' => 'api_promos_referentiel_get_subresource', '_api_subresource_context' => ['property' => 'referentiel', 'identifiers' => [['id', 'App\\Entity\\Promo', true]], 'collection' => false, 'operationId' => 'api_promos_referentiel_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2703 => [[['_route' => 'api_promos_referentiel_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_get_subresource', '_api_subresource_context' => ['property' => 'competences', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false]], 'collection' => true, 'operationId' => 'api_promos_referentiel_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        2760 => [[['_route' => 'api_promos_referentiel_competences_groupecompetences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_groupecompetences_get_subresource', '_api_subresource_context' => ['property' => 'groupecompetences', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false], ['competences', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_promos_referentiel_competences_groupecompetences_get_subresource']], ['id', 'competences', '_format'], ['GET' => 0], null, false, true, null]],
        2801 => [[['_route' => 'api_promos_referentiel_competences_groupecompetences_user_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_groupecompetences_user_get_subresource', '_api_subresource_context' => ['property' => 'user', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false], ['competences', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true]], 'collection' => false, 'operationId' => 'api_promos_referentiel_competences_groupecompetences_user_get_subresource']], ['id', 'competences', 'groupecompetences', '_format'], ['GET' => 0], null, false, true, null]],
        2839 => [[['_route' => 'api_promos_referentiel_competences_groupecompetences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_groupecompetences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competence', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false], ['competences', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true]], 'collection' => true, 'operationId' => 'api_promos_referentiel_competences_groupecompetences_competences_get_subresource']], ['id', 'competences', 'groupecompetences', '_format'], ['GET' => 0], null, false, true, null]],
        2880 => [[['_route' => 'api_promos_referentiel_competences_groupecompetences_competences_niveaux_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_groupecompetences_competences_niveaux_get_subresource', '_api_subresource_context' => ['property' => 'niveau', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false], ['competences', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true], ['competence', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_promos_referentiel_competences_groupecompetences_competences_niveaux_get_subresource']], ['id', 'competences', 'groupecompetences', 'competence', '_format'], ['GET' => 0], null, false, true, null]],
        2914 => [[['_route' => 'api_promos_referentiel_competences_niveaux_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_subresource_operation_name' => 'api_promos_referentiel_competences_niveaux_get_subresource', '_api_subresource_context' => ['property' => 'niveau', 'identifiers' => [['id', 'App\\Entity\\Promo', true], ['referentiel', 'App\\Entity\\Referentiel', false], ['competences', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_promos_referentiel_competences_niveaux_get_subresource']], ['id', 'competences', '_format'], ['GET' => 0], null, false, true, null]],
        2942 => [[['_route' => 'api_profilsorties_profilsortie_promo_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_collection_operation_name' => 'profilsortie_promo'], ['id'], ['GET' => 0], null, false, false, null]],
        2960 => [[['_route' => 'api_profilsorties_profilsortie_item_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_collection_operation_name' => 'profilsortie_item'], ['idp', 'id'], ['GET' => 0], null, false, true, null]],
        2992 => [
            [['_route' => 'api_profils_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_profils_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_profils_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'api_profils_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'put'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        3020 => [
            [['_route' => 'api_profilsorties_profilsortie_id_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_item_operation_name' => 'profilsortie_id'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_profilsorties_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'api_profilsorties_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_item_operation_name' => 'put'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_profilsorties_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profilsortie', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        3065 => [[['_route' => 'api_referentiels_show_referentiel_groupecompetence_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_collection_operation_name' => 'show_referentiel_groupecompetence'], [], ['GET' => 0], null, false, false, null]],
        3085 => [[['_route' => 'api_referentiels_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null]],
        3106 => [[['_route' => 'api_referentiels_show_referentiel_groupecompetence_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_item_operation_name' => 'show_referentiel_groupecompetence'], ['id'], ['GET' => 0], null, false, false, null]],
        3115 => [
            [['_route' => 'api_referentiels_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_referentiels_update_referentiel_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiel', '_api_item_operation_name' => 'update_referentiel'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        3176 => [[['_route' => 'api_referentiels_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_referentiels_competences_get_subresource', '_api_subresource_context' => ['property' => 'competences', 'identifiers' => [['id', 'App\\Entity\\Referentiel', true]], 'collection' => true, 'operationId' => 'api_referentiels_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        3227 => [[['_route' => 'api_referentiels_competences_groupecompetences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_subresource_operation_name' => 'api_referentiels_competences_groupecompetences_get_subresource', '_api_subresource_context' => ['property' => 'groupecompetences', 'identifiers' => [['id', 'App\\Entity\\Referentiel', true], ['competences', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_referentiels_competences_groupecompetences_get_subresource']], ['id', 'competences', '_format'], ['GET' => 0], null, false, true, null]],
        3261 => [
            [['_route' => 'api_competences_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_competences_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_competences_update_competence_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_item_operation_name' => 'update_competence'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        3309 => [[['_route' => 'api_competences_groupecompetences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupecompetence', '_api_subresource_operation_name' => 'api_competences_groupecompetences_get_subresource', '_api_subresource_context' => ['property' => 'groupecompetences', 'identifiers' => [['id', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_competences_groupecompetences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        3350 => [[['_route' => 'api_competences_groupecompetences_user_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_competences_groupecompetences_user_get_subresource', '_api_subresource_context' => ['property' => 'user', 'identifiers' => [['id', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true]], 'collection' => false, 'operationId' => 'api_competences_groupecompetences_user_get_subresource']], ['id', 'groupecompetences', '_format'], ['GET' => 0], null, false, true, null]],
        3388 => [[['_route' => 'api_competences_groupecompetences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_competences_groupecompetences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competence', 'identifiers' => [['id', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true]], 'collection' => true, 'operationId' => 'api_competences_groupecompetences_competences_get_subresource']], ['id', 'groupecompetences', '_format'], ['GET' => 0], null, false, true, null]],
        3429 => [[['_route' => 'api_competences_groupecompetences_competences_niveaux_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_subresource_operation_name' => 'api_competences_groupecompetences_competences_niveaux_get_subresource', '_api_subresource_context' => ['property' => 'niveau', 'identifiers' => [['id', 'App\\Entity\\Competence', true], ['groupecompetences', 'App\\Entity\\Groupecompetence', true], ['competence', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_competences_groupecompetences_competences_niveaux_get_subresource']], ['id', 'groupecompetences', 'competence', '_format'], ['GET' => 0], null, false, true, null]],
        3463 => [[['_route' => 'api_competences_niveaux_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_subresource_operation_name' => 'api_competences_niveaux_get_subresource', '_api_subresource_context' => ['property' => 'niveau', 'identifiers' => [['id', 'App\\Entity\\Competence', true]], 'collection' => true, 'operationId' => 'api_competences_niveaux_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        3490 => [
            [['_route' => 'api_tags_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_item_operation_name' => 'get'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_tags_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_tags_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'api_tags_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tag', '_api_item_operation_name' => 'put'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        3527 => [[['_route' => 'api_apprenants_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'get', 'id' => null], ['id'], ['GET' => 0], null, false, true, null]],
        3548 => [
            [['_route' => 'api_apprenants_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_apprenants_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'patch'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'api_apprenants_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'put'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        3567 => [[['_route' => 'api_users_get_admin_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'get_admin'], ['id'], ['GET' => 0], null, false, true, null]],
        3614 => [
            [['_route' => 'api_promo_briefs_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_promo_briefs_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        3653 => [
            [['_route' => 'api_promo_briefs_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_promo_briefs_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_promo_briefs_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_promo_briefs_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\PromoBrief', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        3701 => [[['_route' => 'api_profils_users_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_profils_users_get_subresource', '_api_subresource_context' => ['property' => 'users', 'identifiers' => [['id', 'App\\Entity\\Profil', true]], 'collection' => true, 'operationId' => 'api_profils_users_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        3751 => [[['_route' => 'api_profilsorties_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_profilsorties_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Profilsortie', true]], 'collection' => true, 'operationId' => 'api_profilsorties_apprenants_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        3793 => [
            [['_route' => 'api_ressources_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_ressources_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        3832 => [
            [['_route' => 'api_ressources_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_ressources_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_ressources_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_ressources_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Ressource', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        3887 => [
            [['_route' => 'api_livrable_attendus_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_livrable_attendus_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        3926 => [
            [['_route' => 'api_livrable_attendus_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_livrable_attendus_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_livrable_attendus_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_livrable_attendus_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrableAttendu', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        3974 => [
            [['_route' => 'api_livrable_partiels_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrablePartiel', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_livrable_partiels_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrablePartiel', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_livrable_partiels_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrablePartiel', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_livrable_partiels_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\LivrablePartiel', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        4004 => [[['_route' => 'api_livrables_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null]],
        4042 => [
            [['_route' => 'api_livrables_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_livrables_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_livrables_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_livrables_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Livrable', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        4102 => [
            [['_route' => 'api_commentaire_generals_add_commentaire_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_collection_operation_name' => 'add_commentaire'], ['idp', 'ida'], ['POST' => 0], null, false, false, null],
            [['_route' => 'api_commentaire_generals_get_commentaire_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\CommentaireGeneral', '_api_collection_operation_name' => 'get_commentaire'], ['idp', 'ida'], ['GET' => 0], null, false, false, null],
        ],
        4148 => [
            [['_route' => 'api_niveaux_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_niveaux_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_niveaux_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_niveaux_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Niveau', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
