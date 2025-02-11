<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\TeamMatchResult;
use App\Entity\Tournament;
use App\Form\TournamentFilterType;
use App\Form\TournamentType;
use App\Manager\GenerateMatch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/tournament')]
class TournamentController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly GenerateMatch          $generateMatch,
    )
    {
    }

    #[Route('/add', name: 'app_tournament_add')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Request $request): Response
    {
        $form = $this->createForm(TournamentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tournament = $form->getData();

            $this->em->persist($tournament);
            $this->em->flush();

            $this->addFlash('success', 'Tournoi créé avec succès !');

            return $this->redirectToRoute('app_tournament_list');
        }

        return $this->render('tournament/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/list', name: 'app_tournament_list')]
    public function list(Request $request): Response
    {
        $form = $this->createForm(TournamentFilterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedSports = $form->get('sports')->getData();
            $tournaments = $this->em->getRepository(Tournament::class)->findWithFilter($selectedSports);
        } else {
            $tournaments = $this->em->getRepository(Tournament::class)->findAll();
        }

        return $this->render('tournament/list.html.twig', [
            'tournaments' => $tournaments,
            'filterForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_tournament_show')]
    public function show(int $id): Response
    {
        $tournament = $this->em->getRepository(Tournament::class)->find($id);

        if (!$tournament) {
            throw $this->createNotFoundException('Tournoi non trouvé.');
        }

        $teams = $this->em->getRepository(Team::class)->findBy(['tournament' => $tournament]);
        $matches = $this->em->getRepository(TeamMatchResult::class)->findBy(
            ['tournament' => $tournament],
            ['phase' => 'ASC']
        );

        return $this->render('tournament/show.html.twig', [
            'tournament' => $tournament,
            'teams' => $teams,
            'matches' => $matches,
        ]);
    }

    #[Route('/{id}/update-scores', name: 'app_tournament_update_scores', methods: ['POST'])]
    public function updateScores(Request $request, Tournament $tournament): Response
    {
        $matches = $this->em->getRepository(TeamMatchResult::class)->findBy([
            'tournament' => $tournament
        ]);

        $allScoresFilled = true;

        foreach ($matches as $match) {
            $homeScore = $request->request->get("home_score_{$match->getId()}");
            $visitorScore = $request->request->get("visitor_score_{$match->getId()}");

            if ($homeScore !== null && $visitorScore !== null) {
                $match->setHomeScore((int)$homeScore);
                $match->setVisitorScore((int)$visitorScore);

                if ($homeScore > $visitorScore) {
                    $match->setWinner($match->getHome());
                } elseif ($visitorScore > $homeScore) {
                    $match->setWinner($match->getVisitor());
                }

                $this->em->persist($match);
            } else {
                $allScoresFilled = false;
            }
        }

        $this->em->flush();

        if ($allScoresFilled) {
            $this->generateMatch->generateNextPhase($tournament);
        }

        return $this->redirectToRoute('app_tournament_show', ['id' => $tournament->getId()]);
    }

}
