<?php

namespace App\Form;

use App\Entity\Property;
use App\Service\PropertyHeatHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('surface', IntegerType::class, [
                'label' => 'Surface (en m²)',
            ])
            ->add('rooms', IntegerType::class, [
                'label' => 'Pièces'
            ])
            ->add('bedrooms', IntegerType::class, [
                'label' => 'Chambres'
            ])
            ->add('floor', IntegerType::class, [
                'label' => 'Étages',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix',
            ])
            ->add('heat', ChoiceType::class, [
                'label' => 'Chauffage',
                'choices' => PropertyHeatHelper::HEAT,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('postal_code', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('sold', CheckboxType::class, [
                'label' => 'Vendu',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

}
