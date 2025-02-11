<?php

namespace App\Controller;

use App\Repository\TeamMatchResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamMatchResultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TeamMatchResultRepository $teamMatchResultRepository): Response
    {
        $teamMatchResults = $teamMatchResultRepository->findAll();

        return $this->render('home/home.html.twig', [
            'teamMatchResults' => $teamMatchResults,
        ]);
    }
}
