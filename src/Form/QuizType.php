<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('cover', TextType::class, [
                'attr' => [
                    'class' => 'form-control m-1 p-1',
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'm-1 p-1'
                ],
            ])
            ->add('questions', EntityType::class, [
                'required' => false,
                'class' => Question::class,
                'attr' => [
                    'class' => 'form-check m-1 p-1',
                ],
                'choice_label' => 'question',
                'label' => 'Ajouter ces questions',
                'label_attr' => [
                    'class' => 'form-check-label m-1 p-1'
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
