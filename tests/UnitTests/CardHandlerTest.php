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
        $handler = new CardHandler();
        $cardGame = $handler->play();

        $this->assertArrayHasKey('unsortedHand', $cardGame);
        $this->assertArrayHasKey('sortedHand', $cardGame);
        $this->assertArrayHasKey('deck', $cardGame);

        $this->assertCount(10, $cardGame['unsortedHand']);
        $this->assertCount(10, $cardGame['sortedHand']);

        // Test that the deck array has the correct keys
        $this->assertArrayHasKey('colors', $cardGame['deck']);
        $this->assertArrayHasKey('values', $cardGame['deck']);

        // Test that the deck array has the correct number of colors and values
        $this->assertCount(4, $cardGame['deck']['colors']);
        $this->assertCount(13, $cardGame['deck']['values']);
    }
}
