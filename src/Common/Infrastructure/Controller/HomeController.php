<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController
{
    /**
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function __invoke(): Response
    {
        return new Response('Symfony project');
    }
}
