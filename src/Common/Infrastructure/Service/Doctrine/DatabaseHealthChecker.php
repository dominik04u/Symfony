<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Service\Doctrine;

use App\Common\Application\DatabaseHealthCheckerInterface;
use Doctrine\DBAL\Connection;
use Throwable;

class DatabaseHealthChecker implements DatabaseHealthCheckerInterface
{
    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }

    /**
     * @return bool
     */
    public function isHealthy(): bool
    {
        try {
            $this->connection->executeQuery('SELECT 1');

            return true;
        } catch (Throwable $e) {
            return false;
        }
    }
}
