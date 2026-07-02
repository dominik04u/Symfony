<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Controller;

use App\Common\Application\DatabaseHealthCheckerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

readonly class HealthController
{
    /**
     * @param DatabaseHealthCheckerInterface $databaseHealthChecker
     */
    public function __construct(
        private DatabaseHealthCheckerInterface $databaseHealthChecker,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return JsonResponse
     */
    #[Route('/health', name: 'health', methods: ['GET'])]
    public function methodName(): JsonResponse
    {
$this->logger->info('Health check TEST');
        $result = [
            'app_status' => 'ok',
            'db_status' => $this->databaseHealthChecker->isHealthy() ? 'ok' : 'ko',
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }
}
