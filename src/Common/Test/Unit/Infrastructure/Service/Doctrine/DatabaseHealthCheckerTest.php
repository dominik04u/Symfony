<?php

declare(strict_types=1);

namespace App\Common\Test\Unit\Infrastructure\Service\Doctrine;

use App\Common\Infrastructure\Service\Doctrine\DatabaseHealthChecker;
use Doctrine\DBAL\Connection;
use Exception;
use PHPUnit\Framework\MockObject\Exception as MockObjectException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DatabaseHealthCheckerTest extends TestCase
{
    /**
     * @var Connection|MockObject
     */
    private MockObject|Connection $connectionMock;
    /**
     * @var DatabaseHealthChecker
     */
    private DatabaseHealthChecker $databaseHealthChecker;

    /**
     * @return void
     * @throws MockObjectException
     */
    protected function setUp(): void
    {
        $this->connectionMock = $this->createMock(Connection::class);

        $this->databaseHealthChecker = new DatabaseHealthChecker($this->connectionMock);
    }

    public function testIsHealthyTrue(): void
    {
        $this->connectionMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT 1');
        $result = $this->databaseHealthChecker->isHealthy();

        $this->assertTrue($result);
    }

    public function testIsHealthyFalse(): void
    {
        $this->connectionMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT 1')
            ->willThrowException(new Exception());
        $result = $this->databaseHealthChecker->isHealthy();

        $this->assertFalse($result);
    }
}
