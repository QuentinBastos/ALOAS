<?php

namespace App\Controller\Deploy;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Process;

class DeploymentController extends AbstractController
{
    #[Route('/deploy/{token}', name: 'app_deploy', methods: ['GET'])]
    public function deploy(Request $request, string $token): Response
    {
        // Check against your secret token
        $tokenEnv = $_ENV['DEPLOY_TOKEN'];

        if ($token != $tokenEnv) {
            throw $this->createAccessDeniedException('Invalid deployment token');
        }

        // Run migrations
        $process = new Process(['php', 'bin/console', 'doctrine:migrations:migrate', '--no-interaction']);
        $process->run();

        return new Response($process->getOutput());
    }
}