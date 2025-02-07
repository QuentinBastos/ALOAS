<?php

namespace App\Entity;

use App\Repository\TeamMatchResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMatchResultRepository::class)]
class TeamMatchResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Tournament::class, inversedBy: 'teamMatchResults')]
    private Tournament $tournament;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private Team $visitor;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private Team $home;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $visitorScore;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $homeScore;

    #[ORM\Column(type: 'string', length: 255)]
    private string $phase;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private ?Team $winner = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament): void
    {
        $this->tournament = $tournament;
    }

    public function getVisitor(): Team
    {
        return $this->visitor;
    }

    public function setVisitor(Team $visitor): void
    {
        $this->visitor = $visitor;
    }

    public function getHome(): Team
    {
        return $this->home;
    }

    public function setHome(Team $home): void
    {
        $this->home = $home;
    }

    public function getVisitorScore(): int
    {
        return $this->visitorScore;
    }

    public function setVisitorScore(int $visitorScore): void
    {
        $this->visitorScore = $visitorScore;
    }

    public function getHomeScore(): int
    {
        return $this->homeScore;
    }

    public function setHomeScore(int $homeScore): void
    {
        $this->homeScore = $homeScore;
    }

    public function getPhase(): string
    {
        return $this->phase;
    }

    public function setPhase(string $phase): void
    {
        $this->phase = $phase;
    }

    public function getWinner(): ?Team
    {
        return $this->winner;
    }

    public function setWinner(?Team $winner): void
    {
        $this->winner = $winner;
    }
}