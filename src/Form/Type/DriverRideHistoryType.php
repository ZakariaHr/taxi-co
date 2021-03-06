<?php

namespace App\Form\Type;


use App\Entity\Ride;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DriverRideHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rides', EntityType::class, [
                'label' => 'Select a car: ',
                'class' => Ride::class,
                'choice_label' => 'getDisplayName',
            ])
            ->add('date', DateType::class, ['data' => new \DateTime(), 'label' => 'Select a date: '])
            ->add('save', SubmitType::class)
        ;
    }
}