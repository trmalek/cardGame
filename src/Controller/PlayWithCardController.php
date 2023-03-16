<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Handler\CardHandler;
use App\Service\RandomlyCardsHandGenerator;

class PlayWithCardController extends AbstractController
{
    #[Route('/play/with/card', name: 'app_play_with_card')]
    public function index(): Response
    {
        $randomGenerator = new RandomlyCardsHandGenerator();
        $handler = new CardHandler($randomGenerator);
        $cardGame = $handler->play();

        return $this->render('/cards/index.html.twig', ['cardGame' => $cardGame]);
    }
}
