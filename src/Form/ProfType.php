<?php

namespace App\Form;

use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $submitButtonLabel = $options['submit_button_label'];

        $builder
            ->add('Name') 
            ->add('cin',null, [
                'label' => 'CIN',
            ]) 
            ->add($submitButtonLabel, SubmitType::class); 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professor::class, 
            'submit_button_label' => 'Ajouter', 
        ]);
    }

}
