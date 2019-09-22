<?php

declare(strict_types=1);

namespace EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Mapper;

use EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper;
use EzSystems\EzPlatformFormBuilder\FieldType\Model\Field;

/**
 * Class CountryFieldMapper.
 */
class CountryFieldMapper extends GenericFieldMapper
{
    /**
     * {@inheritdoc}
     */
    protected function mapFormOptions(Field $field, array $constraints): array
    {
        $options = parent::mapFormOptions($field, $constraints);
        $options['label'] = $field->getAttributeValue('label');
        $options['help'] = $field->getAttributeValue('help');

        return $options;
    }
}
