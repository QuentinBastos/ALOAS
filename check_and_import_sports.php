<?php

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Entity\Sport;

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Symfony application
$kernel = new \App\Kernel('prod', false);
$kernel->boot();
$container = $kernel->getContainer();
$entityManager = $container->get(EntityManagerInterface::class);

// Check if there are any sports in the database
$sportRepository = $entityManager->getRepository(Sport::class);
$sportsCount = $sportRepository->count([]);

if ($sportsCount === 0) {
    $process = new Process(['php', 'bin/console', 'app:import-sports']);
    $process->run();

    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
} else {
    echo "Sports already exist in the database. No import needed.\n";
}