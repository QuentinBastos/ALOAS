<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Pool::class, inversedBy: 'teams')]
    private Pool $pool;

    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'teams')]
    private Collection $games;

    public function __construct()
    {
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

    public function getPool(): Pool
    {
        return $this->pool;
    }

    public function setPool(Pool $pool): void
    {
        $this->pool = $pool;
    }

    public function getGames(): Collection
    {
        return $this->games;
    }

    public function setGames(Collection $games): void
    {
        $this->games = $games;
    }

    public function addGame(Game $game): void
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addTeam($this);
        }
    }

    public function removeGame(Game $game): void
    {
        if ($this->games->removeElement($game)) {
            $game->removeTeam($this);
        }
    }
}