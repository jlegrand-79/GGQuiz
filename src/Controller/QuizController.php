<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuestionRepository;
use App\Repository\QuizRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use function PHPUnit\Framework\isEmpty;

#[Route('/quiz')]
class QuizController extends AbstractController
{
    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

    #[Route('/list', name: 'app_quiz_list', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function list(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/list.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quiz_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, QuizRepository $quizRepository, UserInterface $user): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quiz->setCreator($user);
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    #[Route('/result', name: 'app_quiz_result')]
    #[IsGranted('ROLE_USER')]
    public function result(): Response
    {
        return $this->render('quiz/result.html.twig');
    }

    #[Route('/{id}', name: 'app_quiz_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    #[Route('/{id}/start', name: 'app_quiz_start', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function start(Quiz $quiz): Response
    {
        return $this->render('quiz/start.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    #[Route('/{quizId}/question/{questionId}', name: 'app_quiz_question')]
    #[Entity('quiz', options: ['mapping' => ['quizId' => 'id']])]
    #[Entity('question', options: ['mapping' => ['questionId' => 'id']])]
    #[IsGranted('ROLE_USER')]
    public function askQuestion(Quiz $quiz, int $questionId, QuestionRepository $questionRepository): Response
    {
        $question = $questionRepository->findOneById($questionId);
        $questions = $quiz->getQuestions();
        $questionArray = [];
        foreach ($questions as $key => $value) {
            $questionArray[] = $value;
        }

        $questionIndex = 0;
        foreach ($questionArray as $key => $value) {
            if ($value->getId() == $questionId) {
                $questionIndex = $key;
                break;
            }
        }

        $questionPosition = $questionIndex + 1;

        $quizLength = count($questionArray);
        if ($questionIndex + 1 < $quizLength) {
            $nextQuestionId = $questionArray[$questionIndex + 1]->getId();
            $nextQuestion = $questionRepository->findById($nextQuestionId);
        } else {
            $nextQuestion = [];
        }

        if (($nextQuestion != [])) {
            return $this->render('question/ask.html.twig', [
                'quiz' => $quiz,
                'question' => $question,
                'question_position' => $questionPosition,
                'next_question' => $nextQuestion,
            ]);
        } else {
            return $this->render('question/ask.html.twig', [
                'quiz' => $quiz,
                'question' => $question,
                'question_position' => $questionPosition,
            ]);
        }
    }

    #[Route('/{id}/edit', name: 'app_quiz_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $quiz->getId(), $request->request->get('_token'))) {
            $quizRepository->remove($quiz, true);
        }

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }
}
