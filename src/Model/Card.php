<?php

declare(strict_types=1);

namespace App\Model;

final class Card
{
    public function __construct(private string $color, private string $value)
    {
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
