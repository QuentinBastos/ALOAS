<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    public function show(Request $request): Response
    {
        $exception = $request->attributes->get('exception');
        $code = $exception ? $exception->getStatusCode() : 500;

        return $this->render('error/error.html.twig', [
            'code' => $code,
        ]);
    }
}