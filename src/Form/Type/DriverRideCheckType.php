<?php

namespace App\Form\Type;


use App\Entity\Driver;
use App\Entity\Ride;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DriverRideCheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ride', EntityType::class, [
                'label' => 'Select a car: ',
                'class' => Ride::class,
                'choice_label' => 'getDisplayName',
            ])
            ->add('driver', EntityType::class, [
                'label' => 'Select a driver: ',
                'class' => Driver::class,
                'choice_label' => 'getDriverFullname',
            ])
            ->add('save', SubmitType::class);
    }
}