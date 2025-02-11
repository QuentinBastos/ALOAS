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
        $dateFilter = $request->query->get('dateFilter');

        $queryBuilder = $teamMatchResultRepository->createQueryBuilder('t')
            ->where('t.visitorScore IS NOT NULL')
            ->andWhere('t.homeScore IS NOT NULL');

        if ($dateFilter) {
            $dateFilter = \DateTime::createFromFormat('Y-m-d', $dateFilter);

            $queryBuilder->leftJoin('t.tournament', 'tour')
                ->andWhere('tour.date = :dateFilter')
                ->setParameter('dateFilter', $dateFilter);
        }

        $teamMatchResults = $queryBuilder->getQuery()->getResult();

        return $this->render('home/home.html.twig', [
            'teamMatchResults' => $teamMatchResults,
        ]);
    }
}
