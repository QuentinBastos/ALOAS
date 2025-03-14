<?php

namespace App\Controller\Deploy;

use App\Command\ImportSportsCommand;
use App\Command\ImportUserCommand;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_ANONYMOUS')]
class DeploymentController extends AbstractController
{

    public function __construct(
        private readonly ImportSportsCommand $importSportsCommand,
        private readonly ImportUserCommand   $importUserCommand,
    )
    {
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/deploy/{token}', name: 'app_deploy', methods: ['GET'])]
    public function deploy(Request $request, string $token, DependencyFactory $dependencyFactory): Response
    {
        $envToken = $_ENV['DEPLOY_TOKEN'];
        if ($token != $envToken) {
            throw $this->createAccessDeniedException('Invalid deployment token');
        }

        try {
            $application = new Application();
            $application->setAutoExit(false);
            $application->add(new MigrateCommand($dependencyFactory));

            $input = new ArrayInput([
                'command' => 'migrations:migrate',
                '--no-interaction' => true,
            ]);

            $output = new BufferedOutput();
            $returnCode = $application->run($input, $output);
            $content = $output->fetch();

            return new Response(
                "Migration completed with return code: $returnCode\n\n$content",
                200,
                ['Content-Type' => 'text/plain']
            );
        } catch (\Exception $e) {
            return new Response(
                "Error running migrations: " . $e->getMessage(),
                500,
                ['Content-Type' => 'text/plain']
            );
        }
    }

    #[Route('/import-sports/{token}', name: 'app_import_sports', methods: ['GET'])]
    public function importSports(Request $request, string $token): Response
    {
        $envToken = $_ENV['IMPORT_TOKEN'];
        if ($token != $envToken) {
            throw $this->createAccessDeniedException('Invalid import token');
        }

        try {
            $application = new Application();
            $application->setAutoExit(false);
            $application->add($this->importSportsCommand);

            $input = new ArrayInput([
                'command' => 'app:import-sports',
            ]);

            $output = new BufferedOutput();
            $returnCode = $application->run($input, $output);
            $content = $output->fetch();

            return new Response(
                "Import completed with return code: $returnCode\n\n$content",
                200,
                ['Content-Type' => 'text/plain']
            );
        } catch (\Exception $e) {
            return new Response(
                "Error running import: " . $e->getMessage(),
                500,
                ['Content-Type' => 'text/plain']
            );
        }
    }

    #[Route('/import-user/{token}/{username}/{password}', name: 'app_import_user', methods: ['GET'])]
    public function importUser(Request $request, string $token, string $username, string $password): Response
    {
        $envToken = $_ENV['IMPORT_TOKEN'];
        if ($token != $envToken) {
            throw $this->createAccessDeniedException('Invalid import token');
        }

        try {
            $application = new Application();
            $application->setAutoExit(false);
            $application->add($this->importUserCommand);

            $input = new ArrayInput([
                'command' => 'app:import-user',
                'username' => $username,
                'password' => $password,
            ]);

            $output = new BufferedOutput();
            $returnCode = $application->run($input, $output);
            $content = $output->fetch();

            return new Response(
                "User import completed with return code: $returnCode\n\n$content",
                200,
                ['Content-Type' => 'text/plain']
            );
        } catch (\Exception $e) {
            return new Response(
                "Error running user import: " . $e->getMessage(),
                500,
                ['Content-Type' => 'text/plain']
            );
        }
    }

    #[Route('/deploy-test', name: 'app_deploy_test')]
    public function deployTest(): Response
    {
        return new Response('Deployment controller is working!');
    }
}