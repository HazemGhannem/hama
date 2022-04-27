<?php

namespace App\Form;

use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datereclamtion')
            ->add('descriptionreclamtion')
            ->add('imagereclamtion', FileType::class , ['mapped' => false ,'label'=>' please upload a image'])
            ->add('idUser',EntityType::class,[
                'class'=>Utilisateur::class,
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
