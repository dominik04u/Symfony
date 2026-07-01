<?php

namespace App\Product\Infrastructure;

use App\Product\Domain\Product; // ❌ Domain użyty w Infrastructure
use App\Product\Application\CreateProductHandler; // ❌ Application leak

final class BadLeak
{
    public function test(): void
    {
        $product = new Product('test'); // ❌ instancjonowanie Domain w Infra

        $handler = new CreateProductHandler(); // ❌ Application użyte w Infra
    }
}
