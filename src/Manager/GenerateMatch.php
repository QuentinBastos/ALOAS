<?php

namespace App\Manager;

use App\Entity\Tournament;
use App\Entity\TeamMatchResult;
use Doctrine\ORM\EntityManagerInterface;

readonly class GenerateMatch
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    public function generateTournament(Tournament $tournament): void
    {
        $teams = $tournament->getTeams()->toArray();
        shuffle($teams);

        $phase = 1;

        while (count($teams) > 1) {
            $matchups = [];
            $nextRoundTeams = [];

            for ($i = 0; $i < count($teams); $i += 2) {
                if (isset($teams[$i + 1])) {
                    $match = new TeamMatchResult();
                    $match->setTournament($tournament);
                    $match->setHome($teams[$i]);
                    $match->setVisitor($teams[$i + 1]);
                    $match->setPhase($phase);

                    $this->em->persist($match);
                    $matchups[] = $match;
                } else {
                    $nextRoundTeams[] = $teams[$i];
                }
            }

            $this->em->flush();

            foreach ($matchups as $match) {
                $nextRoundTeams[] = null;
            }

            $teams = array_filter($nextRoundTeams);
            $phase++;
        }
    }

    public function deleteOldMatches(Tournament $tournament): void
    {
        $teamMatchResult = $this->em->getRepository(TeamMatchResult::class)->findBy(['tournament' => $tournament]);

        foreach ($teamMatchResult as $match) {
            $this->em->remove($match);
        }

        $this->em->flush();
    }

    public function generateNextPhase(Tournament $tournament): void
    {
        $currentPhase = (int)$tournament->getTeamMatchResults()->last()?->getPhase() ?? 1;
        $matches = $this->em->getRepository(TeamMatchResult::class)->findBy([
            'tournament' => $tournament,
            'phase' => (string)$currentPhase,
        ]);

        $winningTeams = [];
        foreach ($matches as $match) {
            if ($match->getWinner() !== null) {
                $winningTeams[] = $match->getWinner();
            }
        }

        if (count($winningTeams) > 1) {
            $nextPhase = $currentPhase + 1;
            shuffle($winningTeams);

            for ($i = 0; $i < count($winningTeams); $i += 2) {
                if (isset($winningTeams[$i + 1])) {
                    $match = new TeamMatchResult();
                    $match->setTournament($tournament);
                    $match->setHome($winningTeams[$i]);
                    $match->setVisitor($winningTeams[$i + 1]);
                    $match->setPhase((string)$nextPhase);

                    $this->em->persist($match);
                } else {
                    $winningTeams[] = $winningTeams[$i];
                }
            }

            $this->em->flush();
        }
    }


}
