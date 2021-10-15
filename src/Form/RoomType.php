<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('summary')
            ->add('description')
            ->add('capacity')
            ->add('superficy')
            ->add('price')
            ->add('address')
            ->add('imageName', TextType::class,  ['disabled' => true])
            ->add('imageFile', VichImageType::class, ['required' => false])
        ;
        if($options['display_owner']){
            $builder->add('owner');}
            if($options['display_region']){
                $builder->add('region');}
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
            'display_owner' => true,
            'display_region' => true
        ]);

        $resolver->setAllowedTypes('display_owner', 'bool');
        $resolver->setAllowedTypes('display_region', 'bool');
    }
}
