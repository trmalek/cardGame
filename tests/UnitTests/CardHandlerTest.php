<?php

declare(strict_types=1);

namespace App\Tests\UnitTests;

use PHPUnit\Framework\TestCase;
use App\Handler\CardHandler;
use App\Model\Card;

class CardHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGenerateCardsRandomlyWithSortedAndNotSortedHand()
    {
        $handler = new CardHandler(new InMemoryCardsHandGenerator());
        $cardGame = $handler->play();

        $this->assertArrayHasKey('unsortedHand', $cardGame);
        $this->assertArrayHasKey('sortedHand', $cardGame);
        $this->assertArrayHasKey('deck', $cardGame);

        $this->assertCount(10, $cardGame['unsortedHand']);
        $this->assertCount(10, $cardGame['sortedHand']);

        $this->assertArrayHasKey('colors', $cardGame['deck']);
        $this->assertArrayHasKey('values', $cardGame['deck']);

        $this->assertCount(4, $cardGame['deck']['colors']);
        $this->assertCount(13, $cardGame['deck']['values']);
        $this->assertTrue($this->assertSortedCardsHand($this->getExpectedSortedCardsHand(), $cardGame['sortedHand']));
    }

    private function assertSortedCardsHand(array $expectedSortedCardsHand, array $sortedCardsHand): bool
    {
        if(count($expectedSortedCardsHand) !== count($sortedCardsHand)) {
            return false;
        }

        foreach ($expectedSortedCardsHand as $index => $expected) {
            if ($expected->getColor() !== $sortedCardsHand[$index]->getColor() || $expected->getValue() !== $sortedCardsHand[$index]->getValue()) {
                return false;
            }
        }

        return true;
    }

    private function getExpectedSortedCardsHand(): array
    {
        return [
            new Card('Coeur', 'Valet'),
            new Card('Coeur', '9'),
            new Card('Carreaux', 'Valet'),
            new Card('Carreaux', '2'),
            new Card('Carreaux', '6'),
            new Card('Trèfle', '2'),
            new Card('Trèfle', '6'),
            new Card('Trèfle', '6'),
            new Card('Pique', 'Valet'),
            new Card('Pique', 'Roi'),
        ];
    }
}
