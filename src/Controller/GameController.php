<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Repository\QuestionRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/game')]
class GameController extends AbstractController
{
    #[Route('/', name: 'app_game_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, GameRepository $gameRepository): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->save($game, true);

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/start', name: 'app_game_start')]
    #[IsGranted('ROLE_USER')]
    public function start(GameRepository $gameRepository, QuestionRepository $questionRepository): Response
    {
        $game = new Game();
        $game->setPlayer($this->getUser());
        $game->setPlayedAt(new DateTimeImmutable('now'));
        $game->setScore(0);

        $gameRepository->save($game, true);

        $questions = $questionRepository->findAll();
        $nbOfQuestions = count($questions);
        return $this->render('game/start.html.twig', [
            'question' => $questions[0],
            'questions_count' => $nbOfQuestions
        ]);


        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/question/{number}', name: 'app_game_question')]
    #[IsGranted('ROLE_USER')]
    public function nextQuestion(int $number, QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findBy(
            [],
            ['number' => 'ASC'],
        );
        $nbOfQuestions = count($questions);
        $question = $questionRepository->findOneBy([
            'number' => $number,
        ]);
        $questionIndex = array_search($question, $questions);

        if ($questionIndex + 1 < $nbOfQuestions) {
            $nextQuestion = $questions[$questionIndex + 1];
        } else {
            $nextQuestion = null;
        }

        if (!$nextQuestion) {
            return $this->render('game/question.show.html.twig', [
                'question' => $question,
                'questions_count' => $nbOfQuestions
            ]);
        }

        return $this->render('game/question.show.html.twig', [
            'question' => $question,
            'next_question' => $nextQuestion,
            'questions_count' => $nbOfQuestions
        ]);
    }

    #[Route('/result', name: 'app_game_result')]
    #[IsGranted('ROLE_USER')]
    public function result(): Response
    {
        return $this->render('game/result.html.twig');
    }

    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->save($game, true);

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) {
            $gameRepository->remove($game, true);
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }
}
