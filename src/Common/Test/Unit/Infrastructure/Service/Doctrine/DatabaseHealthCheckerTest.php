<?php

declare(strict_types=1);

namespace App\Common\Test\Unit\Infrastructure\Service\Doctrine;

use App\Common\Infrastructure\Service\Doctrine\DatabaseHealthChecker;
use Doctrine\DBAL\Connection;
use Exception;
use PHPUnit\Framework\MockObject\Exception as MockObjectException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class DatabaseHealthCheckerTest extends TestCase
{
    /**
     * @var Connection|MockObject
     */
    private MockObject|Connection $connectionMock;
    /**
     * @var LoggerInterface|MockObject
     */
    private MockObject|LoggerInterface $loggerInterfaceMock;
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
        $this->loggerInterfaceMock = $this->createMock(LoggerInterface::class);

        $this->databaseHealthChecker = new DatabaseHealthChecker($this->connectionMock, $this->loggerInterfaceMock);
    }

    public function testIsHealthyTrue(): void
    {
        $this->connectionMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT 1');
        $this->loggerInterfaceMock->expects($this->once())->method('info');

        $result = $this->databaseHealthChecker->isHealthy();

        $this->assertTrue($result);
    }

    public function testIsHealthyFalse(): void
    {
        $this->connectionMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT 1')
            ->willThrowException(new Exception());
        $this->loggerInterfaceMock->expects($this->never())->method('info');

        $result = $this->databaseHealthChecker->isHealthy();

        $this->assertFalse($result);
    }
}
