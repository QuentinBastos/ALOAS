<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $date = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\ManyToOne(targetEntity: Sport::class, inversedBy: 'tournaments')]
    private Sport $sport;

    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'tournament')]
    private Collection $teams;

    #[ORM\OneToMany(targetEntity: TeamMatchResult::class, mappedBy: 'tournament')]
    private Collection $teamMatchResults;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $metadata = [];

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->teamMatchResults = new ArrayCollection();
        $this->metadata = [];
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

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getSport(): Sport
    {
        return $this->sport;
    }

    public function setSport(Sport $sport): void
    {
        $this->sport = $sport;
    }

    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): void
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setTournament($this);
        }
    }

    public function getTeamMatchResults(): Collection
    {
        return $this->teamMatchResults;
    }

    public function addTeamMatchResult(TeamMatchResult $teamMatchResult): void
    {
        if (!$this->teamMatchResults->contains($teamMatchResult)) {
            $this->teamMatchResults->add($teamMatchResult);
            $teamMatchResult->setTournament($this);
        }
    }

    public function getMetadata(): array
    {
        return $this->metadata ?? [];
    }

    public function setMetadata(?array $metadata): void
    {
        $this->metadata = $metadata;
    }
}