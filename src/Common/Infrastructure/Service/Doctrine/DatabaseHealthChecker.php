<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Service\Doctrine;

use App\Common\Application\DatabaseHealthCheckerInterface;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Throwable;

readonly class DatabaseHealthChecker implements DatabaseHealthCheckerInterface
{
    /**
     * @param Connection $connection
     * @param LoggerInterface $logger
     */
    public function __construct(
        private Connection $connection,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return bool
     */
    public function isHealthy(): bool
    {
        try {
            $this->connection->executeQuery('SELECT 1');
            $this->logger->info('Database is healthy');

            return true;
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());

            return false;
        }
    }
}
