<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Tournament;
use App\Form\TeamCollectionType;
use App\Manager\GenerateMatch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

#[Route('/team')]
class TeamController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly GenerateMatch $generateMatch,
    ) {
    }

    #[Route('/add/{tournamentId}', name: 'app_team_add')]
    public function add(Request $request, int $tournamentId): Response
    {
        $tournament = $this->em->getRepository(Tournament::class)->find($tournamentId);

        if (!$tournament) {
            throw $this->createNotFoundException('Tournoi non trouvé.');
        }

        // Créez un tableau pour stocker les équipes
        $teams = new ArrayCollection();
        $teams->add(new Team()); // Ajoutez une première équipe vide

        // Créez un formulaire pour gérer plusieurs équipes
        $form = $this->createForm(TeamCollectionType::class, ['teams' => $teams]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            foreach ($data['teams'] as $team) {
                $team->setTournament($tournament);
                $this->em->persist($team);
            }
            $this->em->flush();

            $this->addFlash('success', 'Équipes ajoutées avec succès !');
            return $this->redirectToRoute('app_tournament_show', ['id' => $tournamentId]);
        }

        $svgDir = $this->getParameter('kernel.project_dir') . '/assets/images/team/';
        $svgFiles = array_diff(scandir($svgDir), ['.', '..']);

        $this->generateMatch->deleteOldMatches($tournament);
        $this->generateMatch->generateTournament($tournament);
        return $this->render('team/add.html.twig', [
            'form' => $form->createView(),
            'tournament' => $tournament,
            'svgFiles' => $svgFiles,
        ]);
    }

    #[Route('/list/{tournamentId}', name: 'app_team_show_all')]
    public function showAll(int $tournamentId): Response
    {
        $tournament = $this->em->getRepository(Tournament::class)->find($tournamentId);

        if (!$tournament) {
            throw $this->createNotFoundException('Tournoi non trouvé.');
        }

        $teams = $this->em->getRepository(Team::class)->findBy(['tournament' => $tournament]);

        return $this->render('team/list.html.twig', [
            'teams' => $teams,
            'tournament' => $tournament,
        ]);
    }
}
