<?php
declare(strict_types=1);

namespace App\Model;

interface CardsHandGeneratorInterface
{
    public const HAND_SIZE = 10;
    public function generate(array &$cardGame, array &$colors, array &$values): array;
}
