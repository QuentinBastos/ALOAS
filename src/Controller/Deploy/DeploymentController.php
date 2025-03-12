<?php

namespace App\Controller\Deploy;

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

class DeploymentController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/deploy/{token}', name: 'app_deploy', methods: ['GET'])]
    public function deploy(
        Request $request,
        string $token,
        DependencyFactory $dependencyFactory
    ): Response {

        $envToken = $_ENV['DEPLOY_TOKEN'];
        if ($token != $envToken) {
            throw $this->createAccessDeniedException('Invalid deployment token');
        }

        try {
            // Create migration command
            $application = new Application();
            $application->setAutoExit(false);

            $application->add(new MigrateCommand($dependencyFactory));

            // Set up input with no interaction
            $input = new ArrayInput([
                'command' => 'migrations:migrate',
                '--no-interaction' => true,
            ]);

            // Set up output buffer to capture results
            $output = new BufferedOutput();

            // Run the command
            $returnCode = $application->run($input, $output);

            // Get the output
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

    #[Route('/deploy-test', name: 'app_deploy_test')]
    public function deployTest(): Response
    {
        return new Response('Deployment controller is working!');
    }
}