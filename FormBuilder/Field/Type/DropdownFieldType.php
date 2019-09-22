<?php

declare(strict_types=1);

namespace EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Type;

use EzSystems\EzPlatformFormBuilder\Form\Type\Field\AbstractFieldType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DropdownFieldType.
 */
class DropdownFieldType extends AbstractFieldType
{
    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new CallbackTransformer(
            function ($value) {
            },
            function ($value) {
                // Validation
                if ($value === 'option_2') {
                    throw new TransformationFailedException(sprintf('Option2 is not available "%s"', $value));
                }

                return $value;
            }
        ));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'expanded' => true,
            'multiple' => false,
        ]);
    }
}
