<?php

namespace App\Controller;

use App\Repository\TeamMatchResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'app_home')]
    public function index(Request $request, TeamMatchResultRepository $teamMatchResultRepository): Response
    {
        // Récupérer la date de filtre si elle est présente dans l'URL
        $dateFilter = $request->query->get('dateFilter');

        // Initialiser la requête pour récupérer uniquement les résultats avec des scores définis
        $queryBuilder = $teamMatchResultRepository->createQueryBuilder('t')
            ->where('t.visitorScore IS NOT NULL')
            ->andWhere('t.homeScore IS NOT NULL');

        // Si une date est sélectionnée, ajouter une condition de filtrage pour la date du tournoi
        if ($dateFilter) {
            // Convertir la date du formulaire en objet DateTime
            $dateFilter = \DateTime::createFromFormat('Y-m-d', $dateFilter);

            // Ajouter une condition pour filtrer par date
            $queryBuilder->join('t.tournament', 'tour')
                ->andWhere('tour.date = :dateFilter')
                ->setParameter('dateFilter', $dateFilter);
        }

        // Exécuter la requête
        $teamMatchResults = $queryBuilder->getQuery()->getResult();

        // Passer les résultats à la vue
        return $this->render('home/home.html.twig', [
            'teamMatchResults' => $teamMatchResults,
        ]);
    }
}
