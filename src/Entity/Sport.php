<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToMany(targetEntity: Tournament::class, mappedBy: 'sport')]
    private Collection $tournaments;

    public function __construct()
    {
        $this->tournaments = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function setTournaments(Collection $tournaments): void
    {
        $this->tournaments = $tournaments;
    }

    public function addTournament(Tournament $tournament): void
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
            $tournament->setSport($this);
        }
    }

}