<?php
declare(strict_types=1);

namespace App\Tests\UnitTests;

use App\Model\CardsHandGeneratorInterface;
use App\Model\Card;

final class InMemoryCardsHandGenerator implements CardsHandGeneratorInterface
{
    public function generate(array &$cardGame, array &$colors, array &$values): array
    {
        $colors = ['Coeur', 'Carreaux', 'Trèfle', 'Pique'];
        $values = ['4', '8', 'Dame', 'Valet', '7', '5', '10', '2', 'As', '3', '9', 'Roi', '6'];
        $cardGame['deck'] = ['colors' => $colors, 'values' => $values];

        return [
            new Card('Coeur', 'Valet'),
            new Card('Carreaux', '2'),
            new Card('Trèfle', '6'),
            new Card('Carreaux', '6'),
            new Card('Trèfle', '2'),
            new Card('Pique', 'Roi'),
            new Card('Pique', 'Valet'),
            new Card('Coeur', '9'),
            new Card('Trèfle', '6'),
            new Card('Carreaux', 'Valet'),
        ];
    }
}
