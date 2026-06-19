<?php

declare(strict_types=1);

namespace App\Common\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Health
{
    #[Route('/health', name: 'health')]
    public function methodName(): Response
    {
        return new Response('Health 200', 200);
    }
}
