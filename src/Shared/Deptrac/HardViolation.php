<?php

namespace App\Shared\Deptrac;

use App\Common\Controller\HomeController;

final class HardViolation
{
    public function run(): void
    {
        $homeController = new HomeController(); // ❌ Infrastructure used in Shared
    }
}
