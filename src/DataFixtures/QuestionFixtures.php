<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    const QUESTIONS = [
        [
            'question' => 'Quel est le métier d’Obélix dans les aventures d’Astérix et Obélix ?',
            'answer1' => 'Tailleur et livreur de menhirs',
            'answer2' => 'Chef de village',
            'answer3' => 'Chasseur de sangliers',
            'answer4' => 'Forgeron',
            'picture' => '',
            'correct_answer' => 1,
            'author' => 'admin',
            'number' => 1,
        ],
        [
            'question' => 'De quelle couleur est le pantalon du célèbre Astérix ?',
            'answer1' => 'Jaune',
            'answer2' => 'Marron',
            'answer3' => 'Rouge',
            'answer4' => 'Bleu',
            'picture' => '',
            'correct_answer' => 3,
            'author' => 'admin',
            'number' => 2,
        ],
        [
            'question' => 'Qui est cette femme dans le village d’Astérix ?',
            'answer1' => 'Falbala',
            'answer2' => 'Bonemine',
            'answer3' => 'La femme d’Agecanonix',
            'answer4' => 'La femme de Cétautomatix',
            'picture' => 'femme-village-asterix.webp',
            'correct_answer' => 3,
            'author' => 'admin',
            'number' => 3,
        ],
        [
            'question' => 'Quel est le nom du vendeur de poissons du village d’Astérix ?',
            'answer1' => 'Radius',
            'answer2' => 'Assurancetourix',
            'answer3' => 'Cétautomatix',
            'answer4' => 'Ordralfabétix',
            'picture' => 'vendeur-poisson-asterix.webp',
            'correct_answer' => 4,
            'author' => 'admin',
            'number' => 4,
        ],
        [
            'question' => 'Quel est l’instrument de musique préféré d’Assurancetourix dans Astérix ?',
            'answer1' => 'Une harpe',
            'answer2' => 'Une cithare',
            'answer3' => 'Une lyre',
            'answer4' => 'Une corne de brume',
            'picture' => '',
            'correct_answer' => 3,
            'author' => 'admin',
            'number' => 5,
        ],
        [
            'question' => 'Quel est le nom de l’époux de Falbala dans Astérix ?',
            'answer1' => 'Tragicomix',
            'answer2' => 'Cétautomatix',
            'answer3' => 'Goudurix',
            'answer4' => 'Brutus',
            'picture' => 'epoux-falbala.webp',
            'correct_answer' => 1,
            'author' => 'admin',
            'number' => 6,
        ],
        [
            'question' => 'Quel acteur interprétait en 2012 le rôle d’Astérix dans le film “Astérix et Obélix : Au service de sa Majesté” ?',
            'answer1' => 'Clovis Cornillac',
            'answer2' => 'Christian Clavier',
            'answer3' => 'Pierre Niney',
            'answer4' => 'Edouard Baer',
            'picture' => 'acteur-asterix-2012.webp',
            'correct_answer' => 4,
            'author' => 'admin',
            'number' => 7,
        ],
        [
            'question' => 'Comment se nomme le doyen du village d’Astérix ?',
            'answer1' => 'Panoramix',
            'answer2' => 'Abraracourcix',
            'answer3' => 'Agecanonix',
            'answer4' => 'Cétautomatix',
            'picture' => '',
            'correct_answer' => 3,
            'author' => 'admin',
            'number' => 8,
        ],
        [
            'question' => 'Quel est le nom du personnage d’Astérix interprété au cinéma par Gérard Darmon dans Mission Cléopâtre ?',
            'answer1' => 'Numérobis',
            'answer2' => 'Amonbofis',
            'answer3' => 'Jolitorax',
            'answer4' => 'Antivirus',
            'picture' => 'personnage-asterix-darmon.webp',
            'correct_answer' => 2,
            'author' => 'admin',
            'number' => 9,
        ],
        [
            'question' => 'Laquelle de ces propositions ne désigne pas un album de BD Astérix issu de la collection classique ?',
            'answer1' => 'La Serpe d’or',
            'answer2' => 'Les Douze Travaux d’Astérix',
            'answer3' => 'La Galère d’Obélix',
            'answer4' => 'Astérix en Corse',
            'picture' => '',
            'correct_answer' => 2,
            'author' => 'admin',
            'number' => 10,
        ],
        [
            'question' => 'Dans l’album de BD “Astérix chez les Bretons”, quelle boisson remplace la potion magique ?',
            'answer1' => 'Du jus d’orange',
            'answer2' => 'Du thé',
            'answer3' => 'De l’eau bénite',
            'answer4' => 'Du sang de sanglier',
            'picture' => '',
            'correct_answer' => 2,
            'author' => 'admin',
            'number' => 11,
        ],
        [
            'question' => 'Dans "Astérix et Obélix : Mission Cléopâtre", combien de temps est donné par la reine d’Égypte pour construire le plus beau des palais à Alexandrie ?',
            'answer1' => '3 jours',
            'answer2' => '3 mois',
            'answer3' => '3 ans',
            'answer4' => '3 siècles',
            'picture' => '',
            'correct_answer' => 2,
            'author' => 'admin',
            'number' => 12,
        ],
        [
            'question' => 'Quel est le nom du faux devin qui profite de la crédulité des villageois d’Astérix découvert dans “Le Coup du menhir” ?',
            'answer1' => 'Prolix',
            'answer2' => 'Apollosix',
            'answer3' => 'Alambix',
            'answer4' => 'Odalix',
            'picture' => 'faux-devin-asterix.webp',
            'correct_answer' => 1,
            'author' => 'admin',
            'number' => 13,
        ],
        [
            'question' => 'Dans les aventures d’Astérix, qui est le personnage d’Adrénaline ?',
            'answer1' => 'La fille de Vercingétorix',
            'answer2' => 'La fille d’Obélix',
            'answer3' => 'La fille de Jules César',
            'answer4' => 'La fille d’Astérix',
            'picture' => 'adrenaline.webp',
            'correct_answer' => 1,
            'author' => 'admin',
            'number' => 14,
        ],
        [
            'question' => 'Qui est le neveu du chef du village d’Astérix, Abraracourcix ?',
            'answer1' => 'Goudurix',
            'answer2' => 'Cicatrix',
            'answer3' => 'Caius Pupus',
            'answer4' => 'Basilix',
            'picture' => 'neveu-abraracourcix.webp',
            'correct_answer' => 1,
            'author' => 'admin',
            'number' => 15,
        ],
        [
            'question' => 'Laquelle de ces épreuves n’est pas un des 12 Travaux d’Astérix ?',
            'answer1' => 'Vaincre Cylindric le Germain',
            'answer2' => 'Dormir sur la plaine des Trépassés',
            'answer3' => 'Manger le repas préparé par Mannekenpix',
            'answer4' => 'Nettoyer les écuries d’Augias',
            'picture' => '12-travaux-asterix.webp',
            'correct_answer' => 4,
            'author' => 'admin',
            'number' => 16,
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::QUESTIONS as $key => $value) {
            $question = new Question();
            $question->setQuestion(self::QUESTIONS[$key]['question']);
            $question->setAnswer1(self::QUESTIONS[$key]['answer1']);
            $question->setAnswer2(self::QUESTIONS[$key]['answer2']);
            $question->setAnswer3(self::QUESTIONS[$key]['answer3']);
            $question->setAnswer4(self::QUESTIONS[$key]['answer4']);
            $question->setPicture(self::QUESTIONS[$key]['picture']);
            $question->setCorrectAnswer(self::QUESTIONS[$key]['correct_answer']);
            $question->setAuthor($this->getReference(self::QUESTIONS[$key]['author']));
            $question->setNumber(self::QUESTIONS[$key]['number']);
            $manager->persist($question);
            $this->addReference('question_' . $key, $question);
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
