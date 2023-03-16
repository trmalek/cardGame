<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Handler\CardHandler;

class PlayWithCardController extends AbstractController
{
    #[Route('/play/with/card', name: 'app_play_with_card')]
    public function index(): Response
    {
        $handler = new CardHandler();
        $cardGame = $handler->play();

        return $this->render('/cards/index.html.twig', ['cardGame' => $cardGame]);
    }
}
