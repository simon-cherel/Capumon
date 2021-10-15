<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CommentId')
            ->add('Content')
            ->add('created')
            ->add('author')
            ->add('ReservationIdComment')
        ;
        if($options['display_client']){
            $builder->add('client');}
        if($options['display_room']){
                $builder->add('room');}
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'display_client' => true,
            'display_room' => true
        ]);
        $resolver->setAllowedTypes('display_client', 'bool');
        $resolver->setAllowedTypes('display_room', 'bool');
    }
}
