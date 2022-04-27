<?php

namespace App\Form;

use App\Entity\Reservationservice;
use App\Entity\Services;
use App\Entity\Utilisateur;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReservationserviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('heuredeb')
            ->add('heurefin')
            ->add('idservice',EntityType::class,[
                'class'=>Services::class,
               ])
            ->add('iduser',EntityType::class,[
                'class'=>Utilisateur::class,
               ])
            ->add('prixresserv')
            ->add('etat')
          
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationservice::class,
        ]);
    }
}
