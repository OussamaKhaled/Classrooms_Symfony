<?php

namespace App\Form;

use App\Entity\Classroom;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $submitButtonLabel = $options['submit_button_label'];

        $builder
            ->add('Name') // Add a field named 'Name'
            ->add($submitButtonLabel, SubmitType::class); 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class, 
            'submit_button_label' => 'Ajouter', 
        ]);
    }

}
