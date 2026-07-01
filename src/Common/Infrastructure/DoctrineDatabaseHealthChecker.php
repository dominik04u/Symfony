<?php

declare(strict_types=1);

namespace App\Common\Infrastructure;

use App\Common\Application\DatabaseHealthCheckerInterface;
use Doctrine\DBAL\Connection;
use Throwable;

class DoctrineDatabaseHealthChecker implements DatabaseHealthCheckerInterface
{
    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection) {}

    /**
     * @return bool
     */
    public function isHealthy(): bool
    {
        try {
            $this->connection->executeQuery('SELECT 1');

            return true;
        } catch (Throwable $e) {
            var_dump($e);
            return false;
        }
    }
}
