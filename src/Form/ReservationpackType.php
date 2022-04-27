<?php

namespace App\Form;

use App\Entity\Packs;
use App\Entity\Reservationpack;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ReservationpackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('heuredeb')
            ->add('heurefin')
            ->add('prixrespack')
            ->add('etat', CheckboxType::class, array(
                'required' => false,
                'value' => 1,
            ))
            ->add('iduser',EntityType::class,[
                'class'=>Utilisateur::class,
               ])
            ->add('idpack',EntityType::class,[
                'class'=>Packs::class,
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationpack::class,
        ]);
    }
}
