<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ReservationId')
            ->add('ReservationAdress')
            ->add('NumberGuests')
            ->add('StartDate')
            ->add('EndDate')
            ->add('HostName')
            ->add('GuestName')
            ->add('NumberNights')
            ->add('PaymentTotal');
            if($options['display_client']){
            $builder->add('client');}
            if($options['display_room']){
                $builder->add('room');}
             if($options['display_unavailable_period']){
                    $builder->add('unavailable_period');}
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'display_client' => true,
            'display_room' => true,
            'display_unavailable_period' => true
        ]);
        $resolver->setAllowedTypes('display_client', 'bool');
        $resolver->setAllowedTypes('display_room', 'bool');
        $resolver->setAllowedTypes('display_unavailable_period', 'bool');
    }
}
