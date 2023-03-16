<?php
declare(strict_types=1);

namespace App\Handler;

use App\Model\Card;
use App\Model\CardBuilder;
use App\Model\CardsHandGeneratorInterface;

final class CardHandler
{
    private array $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];
    private array $values = ["As", "5", "10", "8", "6", "7", "4", "2", "3", "9", "Dame", "Roi", "Valet"];

    public function __construct(private CardsHandGeneratorInterface $generator)
    {
    }

    public function play(): array
    {
        $cardGame = [];
        $cards = $this->generator->generate($cardGame, $this->colors, $this->values);
        $cardGame['unsortedHand'] = $cards;
        $this->sortCards($cards, $this->colors, $this->values);
        $cardGame['sortedHand'] = $cards;

        return $cardGame;
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
