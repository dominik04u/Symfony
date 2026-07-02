<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Doctrine\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Index (name: 'IDX_PRODUCT_ID', columns: ['id'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(unique: true, length: 25)]
    public string $sku;

    #[ORM\Column(length: 255)]
    public string $name;

    #[ORM\Column]
    public float $price;

    #[ORM\Column(type: Types::TEXT)]
    public string $description;

    #[ORM\Column]
    public int $stock;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column]
    public bool $enabled;
}
