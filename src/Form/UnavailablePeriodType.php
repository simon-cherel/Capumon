<?php

namespace App\Form;

use App\Entity\UnavailablePeriod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnavailablePeriodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Start')
            ->add('ending')
        ;
        if($options['display_owner']){
            $builder->add('owner');}
            if($options['display_room']){
                $builder->add('room');}
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UnavailablePeriod::class,
            'display_owner' => true,
            'display_room' => true,
        ]);
    }
}
