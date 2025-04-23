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
        '/event' => [[['_route' => 'app_event_index', '_controller' => 'App\\Controller\\EventController::index'], null, ['GET' => 0], null, false, false, null]],
        '/event/new' => [[['_route' => 'app_event_new', '_controller' => 'App\\Controller\\EventController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/event/event/showclient' => [[['_route' => 'app_event_public', '_controller' => 'App\\Controller\\EventController::list'], null, ['GET' => 0], null, false, false, null]],
        '/' => [[['_route' => 'app_home_controll', '_controller' => 'App\\Controller\\HomeControllController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/supprimer\\-categorie/([^/]++)(*:72)'
                .'|/modifier\\-categorie/([^/]++)(*:108)'
                .'|/event/(?'
                    .'|([^/]++)(*:134)'
                    .'|event/([^/]++)/edit(*:161)'
                    .'|([^/]++)(*:177)'
                    .'|event/showEvent/([^/]++)(*:209)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        72 => [[['_route' => 'supprimer_categorie', '_controller' => 'App\\Controller\\CategorieEventController::supprimerCategorie'], ['id'], null, null, false, true, null]],
        108 => [[['_route' => 'modifier_categorie', '_controller' => 'App\\Controller\\CategorieEventController::modifierCategorie'], ['id'], null, null, false, true, null]],
        134 => [[['_route' => 'app_event_show', '_controller' => 'App\\Controller\\EventController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        161 => [[['_route' => 'app_event_edit', '_controller' => 'App\\Controller\\EventController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        177 => [[['_route' => 'app_event_delete', '_controller' => 'App\\Controller\\EventController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        209 => [
            [['_route' => 'event_show', '_controller' => 'App\\Controller\\EventController::showevent'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
