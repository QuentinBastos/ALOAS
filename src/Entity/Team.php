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

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Tournament::class, inversedBy: 'teams')]
    private Tournament $tournament;

    #[ORM\OneToMany(targetEntity: TeamMatchResult::class, mappedBy: 'visitor')]
    private Collection $visitorMatches;

    #[ORM\OneToMany(targetEntity: TeamMatchResult::class, mappedBy: 'home')]
    private Collection $homeMatches;

    public function __construct()
    {
        $this->visitorMatches = new ArrayCollection();
        $this->homeMatches = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament): void
    {
        $this->tournament = $tournament;
    }

    public function getVisitorMatches(): Collection
    {
        return $this->visitorMatches;
    }

    public function getHomeMatches(): Collection
    {
        return $this->homeMatches;
    }
}