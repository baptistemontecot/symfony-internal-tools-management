<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

final class SwaggerController extends AbstractController
{
    #[Route('/', name: 'swagger_ui')]
    public function index(): RedirectResponse
    {
        return $this->redirect('/swagger-ui/index.html');
    }
}
