#ExtendFormBuilderFieldsBundle

## Introduction

eZ Platform Enterprise v2.3 came with the FormBuilder Features. You can find more information in [this blog](https://ez.no/Blog/Sneak-Peek-How-to-create-forms-with-the-new-Form-Builder) about its functionality.

The first thing comes into consideration is about its Extendability. 

- How to add new custom form field
- How to extend those coming with the standard installation

The aim of this bundle is to discover how above requirements can be achieved.

## Custom Form Field

The good news here is if you are already familar with Symfony Forms and have created some of them in the past by extending the `AbstractType` class, you will  not be really challenged to add new Field in eZ Platform.

As example you can read this part in the documentation: [Add Country Form field](https://doc.ezplatform.com/en/latest/guide/extending_form_builder/#extending-form-fields)

You can check also [this bundle](https://github.com/mateuszbieniek/ezplatform-form-builder-country-field) to get the complete code. Thanks @mateuszbieniek

In the above bundle Mateusz Bieniek has add a custom template for the country field. Something that you will of course re-use it after adding your custom field. But as you already find it out it is all about working with symfony forms.

What I did in this bundle is just the same but also manipulating the country list to add some of the countries in the top of it. You can see how it works at the `CountryFormFieldType` class exactly in the `configureOptions` method. Again it is just symfony.

**STOP!** Should we always create the Mapper class? even though you don't have any special configuration to apply! No: is the right answer.

Example:

```
    EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper:
        arguments:
            $fieldIdentifier: 'range'
            $formType: 'Symfony\Component\Form\Extension\Core\Type\RangeType'
        tags:
            - { name: 'ezplatform.form_builder.field_mapper' }
```

Or

```
    EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper:
        arguments:
            $fieldIdentifier: 'color_picker'
            $formType: 'Symfony\Component\Form\Extension\Core\Type\ColorType'
        tags:
            - { name: 'ezplatform.form_builder.field_mapper' }
```

And That's it! The `GenericFieldMapper` will do the rest. You should just pick up the right tag and inject the symfony form type you want.

**Note:** Keep in mind that it is the same process to add new form fields to your Landingpage Block ;)

## Extending standard Form fields

The second part of this bundle is covering the way to override, allow me to say, existing form fields. The example introduced in this bundle is very straightforward to understand.  

First of all you would have to add the field you want into your form, but keeping its values empty. E.g: Create a drop-down list with some options coming from third-party system(PIM/CRM/External Database or just simple yaml files)

To achive this task we could re-use the dropdown field and take advantage of the Decorator Pattern and DataTransformer coming with symfony. 

Steps:

- Decorate the `DropdownFieldMapper` defined in `EzPlatformFormBuilder` bundle. 

- Add custom options you would like to render in the decorator mapper class

- Use DataTransformer in the FieldType class to e.g validate or to build the value for storage based on the selected option

Take a look to `services.yml` as a good starting point.

**Note:** Be aware that the new options will be adapted to all forms and their dropdown fields. To avoid this situation you may add options attributes and depending from the value selected you can render the right options (aka from the mapper)

```
fields:
    dropdown:
        #...
        attributes:
            #...
            dataprovider:
                name: 'Data Provider'
                type: 'select'
                options:
                    choices:
                        'none': 'None'
                        'pim': 'PIM'
                        'crm': 'CRM'
```

In the FiledType class you can have access to the selected option from the `$builder` attributes before or after the form is submitted.

**Note:** Take into account to create a new Field if you have to add complex logic

## Requirement

- eZ Platform Enterprise v2.3+
- Symfony 3.4.x

## Installtion

- Clone this bundle in `src/EzSystems`

- Register it in `Appkernel.php`

```
new EzSystems\ExtendFormBuilderFieldsBundle\EzSystemsExtendFormBuilderFieldsBundle(),
```

- Create a new content and just add `country` and `dropdown`(keep options empty) fields using the FormBuilder.

- Call your content in frontend and be sure to render your form using `ez_render_field(content, <form-field-identifier>)`. Note that you can see the same template in the content view.