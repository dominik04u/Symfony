<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Service\Logging;

use App\Common\Application\RequestIdContext;
use Symfony\Component\HttpKernel\Event\RequestEvent;

readonly class RequestIdListener
{
    /**
     * @param RequestIdContext $requestIdContext
     */
    public function __construct(private RequestIdContext $requestIdContext)
    {
    }

    /**
     * @param RequestEvent $event
     * @return void
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $requestId = $request->headers->get('X-Request-Id') ?? uniqid();

        $this->requestIdContext->setRequestId($requestId);
    }
}
