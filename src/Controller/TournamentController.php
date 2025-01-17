<?php

// src/Controller/TournamentController.php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Entity\Sport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament/new', name: 'app_tournament_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TournamentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tournament = new Tournament();
            $tournament->setName($data['name']);
            $tournament->setLocation($data['location']);

            $sport = $data['sport'];
            $tournament->setSport($sport);

            $entityManager->persist($tournament);
            $entityManager->flush();

            $this->addFlash('success', 'Tournoi créé avec succès !');

            return $this->redirectToRoute('app_tournament_list');
        }

        return $this->render('tournament/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tournament/list', name: 'app_tournament_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $tournaments = $entityManager->getRepository(Tournament::class)->findAll();

        return $this->render('tournament/list.html.twig', [
            'tournaments' => $tournaments,
        ]);
    }

}
