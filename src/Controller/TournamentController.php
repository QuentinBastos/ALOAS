<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentFilterType;
use App\Form\TournamentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournament')]
class TournamentController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
    }

    #[Route('/add', name: 'app_tournament_add')]
    public function new(Request $request): Response
    {
        $form = $this->createForm(TournamentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tournament = new Tournament();
            $tournament->setName($data['name']);
            $tournament->setLocation($data['location']);
            $tournament->setSport($data['sport']);

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

            $tournaments = $this->em->getRepository(Tournament::class)->findBy([
                'sport' => $selectedSports,
            ]);
        } else {
            $tournaments = $this->em->getRepository(Tournament::class)->findAll();
        }

        return $this->render('tournament/list.html.twig', [
            'tournaments' => $tournaments,
            'filterForm' => $form->createView(),
        ]);
    }
}
