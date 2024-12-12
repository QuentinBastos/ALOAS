<?php

namespace App\Entity;

use App\Repository\PoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoolRepository::class)]
class Pool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Tournament::class, inversedBy: 'pools')]
    private Tournament $tournament;

    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'pool')]
    private Collection $teams;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'pool')]
    private Collection $games;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament): void
    {
        $this->tournament = $tournament;
    }

    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function setTeams(Collection $teams): void
    {
        $this->teams = $teams;
    }

    public function getGames(): Collection
    {
        return $this->games;
    }

    public function setGames(Collection $games): void
    {
        $this->games = $games;
    }

    public function addTeam(Team $team): void
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setPool($this);
        }
    }

    public function addGame(Game $game): void
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setPool($this);
        }
    }
}