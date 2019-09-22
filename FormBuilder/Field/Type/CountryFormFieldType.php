<?php

declare(strict_types=1);

namespace EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Type;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CountryFormFieldType.
 */
class CountryFormFieldType extends AbstractType
{
    /**
     * @return string|null
     */
    public function getParent()
    {
        return CountryType::class;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //do what you want to do
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'preferred_choices' => ['DE', 'FR', 'PL'],
        ]);
    }
}
