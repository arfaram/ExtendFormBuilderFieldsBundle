<?php

declare(strict_types=1);

namespace EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Mapper;

use EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper;
use EzSystems\EzPlatformFormBuilder\FieldType\Model\Field;

/**
 * Class DropdownFieldMapper.
 */
class DropdownFieldMapper extends GenericFieldMapper
{
    /**
     * @param \EzSystems\EzPlatformFormBuilder\FieldType\Model\Field $field
     * @param array $constraints
     * @return array
     */
    protected function mapFormOptions(Field $field, array $constraints): array
    {
        $options = parent::mapFormOptions($field, $constraints);
        $options['field'] = $field;
        $options['label'] = $field->getName();
        $options['help'] = $field->getAttributeValue('help');
        $options['choices'] = $this->prepareChoices();

        return $options;
    }

    /**
     * @param string $options
     *
     * @return array
     */
    protected function prepareChoices(): array
    {
        //Add Business Logic
        return [
            'Option1' => 'option_1',
            'Option2' => 'option_2',
            'Option3' => 'option_3',
        ];
    }
}
