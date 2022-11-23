<?php

namespace App\Services;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

final class BackpackUIService
{
    public static function content(string $label = 'Content', string $name = 'content')
    {
        return CRUD::addField(
            self::contentSubfield($label, $name)
        );
    }

    public static function contentSubfield(string $label, string $name)
    {
        return  [   // CKEditor
            'name' => $name,
            'label' => $label,
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
            'options' => [
                'autoGrow_minHeight' => 200,
                'autoGrow_bottomSpace' => 50,
                'removePlugins' => 'resize,maximize',
            ],
        ];
    }

    public static function title()
    {
        CRUD::addField(
            self::titleSubfield()
        );
    }

    public static function titleSubfield()
    {
        return [
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
        ];
    }

    public static function slug()
    {
        CRUD::addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder' => config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);
    }

    public static function description()
    {
        CRUD::field('description');
    }
}
