<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/question', name: 'app_question')]
    public function question(): Response
    {
        return $this->render('home/question.html.twig');
    }

    #[Route('/quiz', name: 'app_quiz')]
    public function quiz(): Response
    {
        return $this->render('home/quiz.html.twig');
    }
}
