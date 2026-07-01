<?php

namespace App\Shared\Deptrac;

use Symfony\Component\Clock\Clock;

final class HardViolation
{
    public function run(): void
    {
        $homeController = new Clock(); // ❌ Infrastructure used in Shared
    }
}
