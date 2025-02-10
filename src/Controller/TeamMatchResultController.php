<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Manager\GenerateMatch;
use App\Repository\TeamMatchResultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamMatchResultController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ){}
    #[Route('/', name: 'home')]
    public function index(TeamMatchResultRepository $teamMatchResultRepository): Response
    {
        // Récupérer tous les résultats de matchs
        $teamMatchResults = $teamMatchResultRepository->findAll();

        // Passer les résultats à la vue
        return $this->render('home/home.html.twig', [
            'teamMatchResults' => $teamMatchResults,
        ]);
    }
}
