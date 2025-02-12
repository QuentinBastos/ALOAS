<?php

namespace App\Manager;

use App\Entity\Tournament;
use App\Entity\TeamMatchResult;
use Doctrine\ORM\EntityManagerInterface;

readonly class GenerateMatch
{

    private const QUALIFIED_TEAMS_KEY = 'direct_qualified_teams';

    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function generateTournament(Tournament $tournament): void
    {
        $teams = $tournament->getTeams()->toArray();
        shuffle($teams);
        $phase = 1;


        $tournament->setMetadata([self::QUALIFIED_TEAMS_KEY => []]);

        while (count($teams) > 1) {
            $matchups = [];
            $nextRoundTeams = [];
            $teamCount = count($teams);


            if ($teamCount % 2 !== 0) {
                $byeTeam = array_pop($teams);

                $qualifiedTeams = $tournament->getMetadata()[self::QUALIFIED_TEAMS_KEY] ?? [];
                $qualifiedTeams[$phase] = $byeTeam->getId();
                $tournament->setMetadata([self::QUALIFIED_TEAMS_KEY => $qualifiedTeams]);
                $nextRoundTeams[] = $byeTeam;
            }

            for ($i = 0; $i < count($teams); $i += 2) {
                if (isset($teams[$i + 1])) {
                    $match = new TeamMatchResult();
                    $match->setTournament($tournament);
                    $match->setHome($teams[$i]);
                    $match->setVisitor($teams[$i + 1]);
                    $match->setPhase($phase);
                    $this->em->persist($match);
                    $matchups[] = $match;
                }
            }

            $this->em->persist($tournament);
            $this->em->flush();

            foreach ($matchups as $match) {
                $nextRoundTeams[] = null;
            }

            $teams = array_filter($nextRoundTeams);
            $phase++;
        }
    }

    public function generateNextPhase(Tournament $tournament): void
    {
        $currentPhase = (int)$tournament->getTeamMatchResults()->last()?->getPhase() ?? 1;
        $matches = $this->em->getRepository(TeamMatchResult::class)->findBy([
            'tournament' => $tournament,
            'phase' => (string)$currentPhase,
        ]);

        $winningTeams = [];

        $metadata = $tournament->getMetadata();
        if (isset($metadata[self::QUALIFIED_TEAMS_KEY][$currentPhase])) {
            $qualifiedTeamId = $metadata[self::QUALIFIED_TEAMS_KEY][$currentPhase];
            foreach ($tournament->getTeams() as $team) {
                if ($team->getId() === $qualifiedTeamId) {
                    $winningTeams[] = $team;
                    break;
                }
            }
        }

        foreach ($matches as $match) {
            if ($match->getWinner() !== null) {
                $winningTeams[] = $match->getWinner();
            }
        }

        if (count($winningTeams) > 1) {
            $nextPhase = $currentPhase + 1;
            shuffle($winningTeams);

            if (count($winningTeams) % 2 !== 0) {
                $byeTeam = array_pop($winningTeams);
                $qualifiedTeams = $tournament->getMetadata()[self::QUALIFIED_TEAMS_KEY] ?? [];
                $qualifiedTeams[$nextPhase] = $byeTeam->getId();
                $tournament->setMetadata([self::QUALIFIED_TEAMS_KEY => $qualifiedTeams]);
                $this->em->persist($tournament);
            }

            for ($i = 0; $i < count($winningTeams); $i += 2) {
                if (isset($winningTeams[$i + 1])) {
                    $match = new TeamMatchResult();
                    $match->setTournament($tournament);
                    $match->setHome($winningTeams[$i]);
                    $match->setVisitor($winningTeams[$i + 1]);
                    $match->setPhase((string)$nextPhase);
                    $this->em->persist($match);
                }
            }

            $this->em->flush();
        }
    }

    public function deleteOldMatches(Tournament $tournament): void
    {
        $teamMatchResult = $this->em->getRepository(TeamMatchResult::class)->findBy(['tournament' => $tournament]);
        foreach ($teamMatchResult as $match) {
            $this->em->remove($match);
        }
        $tournament->setMetadata([self::QUALIFIED_TEAMS_KEY => []]);
        $this->em->persist($tournament);
        $this->em->flush();
    }
}