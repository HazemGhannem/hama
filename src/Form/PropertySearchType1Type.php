<?php

namespace App\Form;

use App\Entity\PropertySearch1;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PropertySearchType1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType :: class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix maximum'
                ]
            ])
            ->add('dates', DateType :: class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Date'
                ]
            ])
            ->add('etatPayer', CheckboxType :: class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Payer/Non Payer'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch1::class,
            'method' => 'get'
        ]);
    }
}
