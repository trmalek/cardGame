<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Card;
use App\Model\CardBuilder;

final class CardHandler
{
    private array $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];
    private array $values = ["As", "5", "10", "8", "6", "7", "4", "2", "3", "9", "Dame", "Roi", "Valet"];
    private const HAND_SIZE = 10;

    public function play(): array
    {
        $cardGame = [];
        $cards = $this->generateHandRandomly($cardGame);
        $cardGame['unsortedHand'] = $cards;
        $this->sortCards($cards, $this->colors, $this->values);
        $cardGame['sortedHand'] = $cards;

        return $cardGame;
    }

    private function generateHandRandomly(array &$cardGame): array
    {
        $cards = [];
        $builder = new CardBuilder();

        shuffle($this->colors);
        shuffle($this->values);
        $cardGame['deck'] = ['colors' => $this->colors, 'values' => $this->values];

        for ($i = 0; $i < self::HAND_SIZE; $i++) {
            $color = $this->colors[array_rand($this->colors)];
            $value = $this->values[array_rand($this->values)];

            $card = $builder->withColor($color)
                ->withValue($value)
                ->build();

            array_push($cards, $card);
        }

        return $cards;
    }

    private function sortCards(array &$cards, array $colors, array $values): void
    {
        usort($cards, function (Card $card1, Card $card2) use ($colors, $values) {
            $diffColors = array_search($card1->getColor(), $colors) - array_search($card2->getColor(), $colors);
            if ($diffColors !== 0) {
                return $diffColors;
            }

            return array_search($card1->getValue(), $values) - array_search($card2->getValue(), $values);
        });
    }
}
