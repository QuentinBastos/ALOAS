<?php

namespace App\Manager;

use App\Entity\Tournament;
use App\Entity\TeamMatchResult;
use Doctrine\ORM\EntityManagerInterface;

class GenerateMatch
{
    public function __construct(private readonly EntityManagerInterface $em)
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

}
