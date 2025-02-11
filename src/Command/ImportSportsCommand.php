<?php

namespace App\Command;

use App\Entity\Sport;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class ImportSportsCommand extends Command
{
    protected static $defaultName = 'app:import-sports';

    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription('Imports sports from a YAML file into the Sport table');
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $yamlFile = __DIR__ . '/../../config/sports.yaml';
        $sportsData = Yaml::parseFile($yamlFile)['sports'];

        foreach ($sportsData as $sportData) {
            $existingSport = $this->em->getRepository(Sport::class)->findOneBy(['name' => $sportData['name']]);
            if (!$existingSport) {
                $sport = new Sport();
                $sport->setName($sportData['name']);
                $this->em->persist($sport);
            }
        }

        $this->em->flush();

        $output->writeln('Sports imported successfully.');

        return Command::SUCCESS;
    }
}