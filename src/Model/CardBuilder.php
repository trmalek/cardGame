<?php

declare(strict_types=1);

namespace App\Model;

use http\Exception\InvalidArgumentException;

final class CardBuilder
{
    private string $color;
    private string $value;

    public function withColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function build(): Card
    {
        if (is_null($this->value) || is_null($this->color)) {
            throw new InvalidArgumentException('a card must have a color and a value !');
        }

        return new Card($this->color, $this->value);
    }
}
