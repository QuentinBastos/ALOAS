<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: TeamMatchResult::class, inversedBy: 'teams')]
    private TeamMatchResult $teamMatchResult;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTeamMatchResult(): TeamMatchResult
    {
        return $this->teamMatchResult;
    }

    public function setTeamMatchResult(TeamMatchResult $teamMatchResult): void
    {
        $this->teamMatchResult = $teamMatchResult;
    }
}