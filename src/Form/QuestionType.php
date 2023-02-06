<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Libellé',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('answer1', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => '1ère option',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('answer2', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => '2ème option',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('answer3', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => '3ème option',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('answer4', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => '4ème option',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('picture', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Image (optionnel)',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
                'required' => false,
            ])
            ->add('correctAnswer', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Bonne option',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ]
            ])
            ->add('quizzes', EntityType::class, [
                'required' => false,
                'class' => Quiz::class,
                'attr' => [
                    'class' => 'form-check m-1 p-1',
                ],
                'choice_label' => 'name',
                'label' => 'Ajouter à ce(s) Quiz(zes)',
                'label_attr' => [
                    'class' => 'form-check-label m-1 p-1'
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
