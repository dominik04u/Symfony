<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Service\Logging;

use App\Common\Application\RequestIdContext;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

readonly class RequestIdProcessor implements ProcessorInterface
{
    /**
     * @param RequestIdContext $requestIdContext
     */
    public function __construct(
        private RequestIdContext $requestIdContext,
    ) {
    }

    /**
     * @param LogRecord $record
     * @return LogRecord
     */
    public function __invoke(LogRecord $record): LogRecord
    {
        $requestId = $this->requestIdContext->getRequestId();
        $record->extra['request_id'] = $requestId;

        return $record;
    }
}
