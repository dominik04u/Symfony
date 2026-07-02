<?php

declare(strict_types=1);

namespace App\Common\Application;

class RequestIdContext
{
    private ?string $requestId = null;

    /**
     * @param string $requestId
     * @return $this
     */
    public function setRequestId(string $requestId): static
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
