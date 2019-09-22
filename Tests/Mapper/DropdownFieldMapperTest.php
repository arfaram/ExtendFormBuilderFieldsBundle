<?php

namespace EzSystems\ExtendFormBuilderFieldsBundle\Tests;

use EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Mapper\DropdownFieldMapper;
use EzSystems\EzPlatformFormBuilder\FieldType\Model\Field;
use PHPUnit\Framework\TestCase;

class DropdownFieldMapperTest extends TestCase
{
    public $fieldMock;

    public function setUp()
    {
        $this->fieldMock = $this->createMock(Field::class);
    }

    /**
     * @dataProvider dropdownDataProvider
     * @throws \ReflectionException
     */
    public function testMapFormOptions($expected)
    {
        $dropdownFieldMapperMock = $this->getMockBuilder(DropdownFieldMapper::class)
            ->setMethodsExcept(['mapFormOptions'])
            ->setMethods(['prepareChoices'])
            ->setConstructorArgs([
                'whatever',
                'EzSystems\ExtendFormBuilderFieldsBundle\FormBuilder\Field\Type\CountryFormFieldType',
            ])
            ->getMock();

        $dropdownFieldMapperMock->method('prepareChoices')
            ->willReturn($expected);

        $class = new \ReflectionClass(DropdownFieldMapper::class);
        $mapFormOptionsMethod = $class->getMethod('mapFormOptions');
        $mapFormOptionsMethod->setAccessible(true);

        $results = $mapFormOptionsMethod->invokeArgs($dropdownFieldMapperMock, [$this->fieldMock, []]);

        $this->assertSame($expected, $results['choices']);
    }

    public function dropdownDataProvider()
    {
        return [
          [
              'food' => ['Mexican' => 'mex', 'Thai' => 'thai', 'Polish' => 'pol'],
          ],
          [
              'places' => ['Germany' => 'DE', 'France' => 'FR', 'Poland' => 'PL'],
          ],
          [
              'whatever' => ['Foo' => 'foo', 'Boo' => 'boo', 'Koo' => 'koo'],
          ],
        ];
    }
}
