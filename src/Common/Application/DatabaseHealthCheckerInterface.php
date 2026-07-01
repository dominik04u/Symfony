<?php

namespace App\Common\Application;

interface DatabaseHealthCheckerInterface
{
    /**
     * @return bool
     */
    public function isHealthy(): bool;
}
