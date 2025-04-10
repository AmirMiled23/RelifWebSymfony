<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/ajouter-evenement' => [[['_route' => 'ajout_event', '_controller' => 'App\\Controller\\CategorieEventController::ajouterCategorie'], null, null, null, false, false, null]],
        '/liste-categories' => [[['_route' => 'liste_categories', '_controller' => 'App\\Controller\\CategorieEventController::listeCategories'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_home_controll', '_controller' => 'App\\Controller\\HomeControllController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/supprimer\\-categorie/([^/]++)(*:72)'
                .'|/modifier\\-categorie/([^/]++)(*:108)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        72 => [[['_route' => 'supprimer_categorie', '_controller' => 'App\\Controller\\CategorieEventController::supprimerCategorie'], ['id'], null, null, false, true, null]],
        108 => [
            [['_route' => 'modifier_categorie', '_controller' => 'App\\Controller\\CategorieEventController::modifierCategorie'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
