<?php

namespace App\Controller;

use App\Service\MediaStackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    public function __construct(private MediaStackService $mediaStackService)
    {
        $this->mediaStackService = $mediaStackService;
    }

    #[Route('/', name: 'app_news')]
    public function index(): Response
    {
        $news = $this->mediaStackService->getNews([
            'limit' => 10,
        ]);

        dump($news);

        return $this->render('news/index.html.twig', [
            'news' => $news['data'],
        ]);
    }
}
