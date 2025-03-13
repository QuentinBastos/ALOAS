<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/' => [
            [['_route' => 'app_home', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null],
            [['_route' => 'home', '_controller' => 'App\\Controller\\TeamMatchResultController::index'], null, null, null, false, false, null],
        ],
        '/deploy-test' => [[['_route' => 'app_deploy_test', '_controller' => 'App\\Controller\\Deploy\\DeploymentController::deployTest'], null, null, null, false, false, null]],
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
                .'|/deploy/([^/]++)(*:23)'
                .'|/import\\-(?'
                    .'|sports/([^/]++)(*:57)'
                    .'|user/([^/]++)/([^/]++)/([^/]++)(*:95)'
                .')'
                .'|/t(?'
                    .'|eam/(?'
                        .'|add/([^/]++)(*:127)'
                        .'|list/([^/]++)(*:148)'
                    .')'
                    .'|ournament/([^/]++)(?'
                        .'|(*:178)'
                        .'|/update\\-scores(*:201)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        23 => [[['_route' => 'app_deploy', '_controller' => 'App\\Controller\\Deploy\\DeploymentController::deploy'], ['token'], ['GET' => 0], null, false, true, null]],
        57 => [[['_route' => 'app_import_sports', '_controller' => 'App\\Controller\\Deploy\\DeploymentController::importSports'], ['token'], ['GET' => 0], null, false, true, null]],
        95 => [[['_route' => 'app_import_user', '_controller' => 'App\\Controller\\Deploy\\DeploymentController::importUser'], ['token', 'username', 'password'], ['GET' => 0], null, false, true, null]],
        127 => [[['_route' => 'app_team_add', '_controller' => 'App\\Controller\\TeamController::add'], ['tournamentId'], null, null, false, true, null]],
        148 => [[['_route' => 'app_team_show_all', '_controller' => 'App\\Controller\\TeamController::showAll'], ['tournamentId'], null, null, false, true, null]],
        178 => [[['_route' => 'app_tournament_show', '_controller' => 'App\\Controller\\TournamentController::show'], ['id'], null, null, false, true, null]],
        201 => [
            [['_route' => 'app_tournament_update_scores', '_controller' => 'App\\Controller\\TournamentController::updateScores'], ['id'], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
