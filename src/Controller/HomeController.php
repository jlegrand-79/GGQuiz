<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/quiz', name: 'app_quiz')]
    #[IsGranted('ROLE_USER')]
    public function quiz(QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findAll();
        return $this->render('home/quiz.html.twig', [
            'question' => $questions[0],
        ]);
    }
}
