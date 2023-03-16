<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\CardsHandGeneratorInterface;

use App\Model\CardBuilder;

final class RandomlyCardsHandGenerator implements CardsHandGeneratorInterface
{
    public function generate(array &$cardGame, array &$colors, array &$values): array
    {
        $cards = [];
        $builder = new CardBuilder();

        shuffle($colors);
        shuffle($values);
        $cardGame['deck'] = ['colors' => $colors, 'values' => $values];

        for ($i = 0; $i < self::HAND_SIZE; $i++) {
            $color = $colors[array_rand($colors)];
            $value = $values[array_rand($values)];

            $card = $builder->withColor($color)
                ->withValue($value)
                ->build();

            array_push($cards, $card);
        }

        return $cards;
    }
}
