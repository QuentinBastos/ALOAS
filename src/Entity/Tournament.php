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

    #[ORM\JoinColumn]
    #[ORM\ManyToOne(targetEntity: Sport::class, inversedBy: 'tournaments')]
    private Sport $sport;

    #[ORM\OneToMany(targetEntity: TeamMatchResult::class, mappedBy: 'tournament')]
    private Collection $teamMatchResult;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    public function __construct()
    {
        $this->teamMatchResult = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSport(): Sport
    {
        return $this->sport;
    }

    public function setSport(Sport $sport): void
    {
        $this->sport = $sport;
    }

    public function getTeamMatchResult(): Collection
    {
        return $this->teamMatchResult;
    }

    public function setTeamMatchResult(Collection $teamMatchResult): void
    {
        $this->teamMatchResult = $teamMatchResult;
    }

    public function addTeamMatchResult(TeamMatchResult $pool): void
    {
        if (!$this->teamMatchResult->contains($pool)) {
            $this->teamMatchResult->add($pool);
            $pool->setTournament($this);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}
