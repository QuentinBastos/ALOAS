<?php

namespace App\Controller\Video;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/video')]
class VideoController extends AbstractController
{
    #[Route(path: '/all', name: 'app_video_all')]
    public function showAll(): Response
    {
        return $this->render('video/all.html.twig');
    }

    #[Route(path: '/add-team', name: 'app_video_team')]
    public function addTeam(): Response
    {
        return $this->render('video/teams.html.twig');
    }

    #[Route(path: '/create-leaderboard', name: 'app_video_leaderboard')]
    public function createLeaderboard(): Response
    {
        return $this->render('video/leaderboard.html.twig');
    }

    #[Route(path: '/add-score', name: 'app_video_score')]
    public function addScore(): Response
    {
        return $this->render('video/score.html.twig');
    }

    #[Route(path: '/help', name: 'app_video_help')]
    public function help(): Response
    {
        return $this->render('video/help.html.twig');
    }
}