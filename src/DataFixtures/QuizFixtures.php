<?php

namespace App\DataFixtures;

use App\Entity\Quiz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuizFixtures extends Fixture implements DependentFixtureInterface
{
    const QUIZZES = [
        'asterix' =>
        [
            'name' => 'Astérix',
            'title' => 'Connaissez-vous bien les aventures des gaulois les plus célèbres du monde ?',
            'description' => 'Nous vous proposons un quiz autour de l\'univers d\'Astérix et Obélix afin de nous replonger dans les '
                . 'bandes dessinées, les films d\'animation et les films de la franchise. Les questions de ce quiz portent tous les '
                . 'personnages hauts en couleur imaginés par Albert Uderzo et René Goscinny comme Assurancetourix, Idéfix, Panoramix, '
                . 'ou bien encore la belle Falbala. Ce quiz est idéal pour les grands enfants qui ont grandi avec ces héros bien français.'
                . 'Malheureusement, la potion magique n\'est pas acceptée pour répondre correctement aux questions, alors bon courage et '
                . 'bon quiz à tous.',
            'cover' => 'asterix.svg',
            'creator' => 'admin',
        ],
        'starwars' =>
        [
            'name' => 'Star Wars',
            'title' => 'Vous êtes un fan de la saga Star Wars ?',
            'description' => 'Mesurez-vous à ce quiz pour savoir si vous contrôlez vraiment la Force et tous les détails de la saga '
                . 'intergalactique de l\'épisode 1 à l\'épisode 9. Nous vous proposons un quiz Star Wars avec des questions qui vont '
                . 'jusqu\'au niveau difficile. Serez-vous de taille pour répondre correctement aux questions sur les personnages comme '
                . 'Yoda, Luke Skywalker, Chewbacca, C-3PO et tous les autres ! Bonne chance à tous.',
            'cover' => 'starwars.svg',
            'creator' => 'admin',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::QUIZZES as $key => $value) {
            $quiz = new Quiz();
            $quiz->setName(self::QUIZZES[$key]['name']);
            $quiz->setTitle(self::QUIZZES[$key]['title']);
            $quiz->setDescription(self::QUIZZES[$key]['description']);
            $quiz->setCover(self::QUIZZES[$key]['cover']);
            $quiz->setCreator($this->getReference(self::QUIZZES[$key]['creator']));
            $manager->persist($quiz);
            $this->addReference('quiz_' . $key, $quiz);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
