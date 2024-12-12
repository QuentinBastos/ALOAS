<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Pool::class, inversedBy: 'games')]
    private Pool $pool;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'games')]
    private Collection $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
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

    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function setTeams(Collection $teams): void
    {
        $this->teams = $teams;
    }

    public function addTeam(Team $team): void
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->addGame($this);
        }
    }

    public function removeTeam(Team $team): void
    {
        if ($this->teams->removeElement($team)) {
            $team->removeGame($this);
        }
    }
}