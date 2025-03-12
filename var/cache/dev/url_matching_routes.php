<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [
            [['_route' => 'app_home', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null],
            [['_route' => 'home', '_controller' => 'App\\Controller\\TeamMatchResultController::index'], null, null, null, false, false, null],
        ],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\Security\\RegistrationController::register'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\Security\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\Security\\SecurityController::logout'], null, null, null, false, false, null]],
        '/tournament/add' => [[['_route' => 'app_tournament_add', '_controller' => 'App\\Controller\\TournamentController::new'], null, null, null, false, false, null]],
        '/tournament/list' => [[['_route' => 'app_tournament_list', '_controller' => 'App\\Controller\\TournamentController::list'], null, null, null, false, false, null]],
        '/video/all' => [[['_route' => 'app_video_all', '_controller' => 'App\\Controller\\Video\\VideoController::showAll'], null, null, null, false, false, null]],
        '/video/add-team' => [[['_route' => 'app_video_team', '_controller' => 'App\\Controller\\Video\\VideoController::addTeam'], null, null, null, false, false, null]],
        '/video/create-leaderboard' => [[['_route' => 'app_video_leaderboard', '_controller' => 'App\\Controller\\Video\\VideoController::createLeaderboard'], null, null, null, false, false, null]],
        '/video/add-score' => [[['_route' => 'app_video_score', '_controller' => 'App\\Controller\\Video\\VideoController::addScore'], null, null, null, false, false, null]],
        '/video/help' => [[['_route' => 'app_video_help', '_controller' => 'App\\Controller\\Video\\VideoController::help'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/deploy/([^/]++)(*:218)'
                .'|/t(?'
                    .'|eam/(?'
                        .'|add/([^/]++)(*:250)'
                        .'|list/([^/]++)(*:271)'
                    .')'
                    .'|ournament/([^/]++)(?'
                        .'|(*:301)'
                        .'|/update\\-scores(*:324)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        218 => [[['_route' => 'app_deploy', '_controller' => 'App\\Controller\\Deploy\\DeploymentController::deploy'], ['token'], ['GET' => 0], null, false, true, null]],
        250 => [[['_route' => 'app_team_add', '_controller' => 'App\\Controller\\TeamController::add'], ['tournamentId'], null, null, false, true, null]],
        271 => [[['_route' => 'app_team_show_all', '_controller' => 'App\\Controller\\TeamController::showAll'], ['tournamentId'], null, null, false, true, null]],
        301 => [[['_route' => 'app_tournament_show', '_controller' => 'App\\Controller\\TournamentController::show'], ['id'], null, null, false, true, null]],
        324 => [
            [['_route' => 'app_tournament_update_scores', '_controller' => 'App\\Controller\\TournamentController::updateScores'], ['id'], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
