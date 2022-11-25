<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Author;
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
        return  [   
            'name' => $name,
            'label' => $label,
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
            'options' => [
                'height' => 400,
                'autoGrow_minHeight' => 1000,
                'autoGrow_bottomSpace' => 500,
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
        CRUD::field('description')->type('textarea');
    }

    public static function image($name = 'image', $label = '', $aspectRatio = 3/2, $isCrop = true)
    {
        CRUD::addField([
            'label' => $label === '' ? ucfirst($name) : $label,
            'name' => $name,
            'type' => 'image',
            'crop' => $isCrop, // set to true to allow cropping, false to disable
            'aspect_ratio' => $aspectRatio,
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
        ]);
    }

    public static function dateRange($label = 'Date Range')
    {
        CRUD::addField(
            [   // date_range
                'name' => ['date_start', 'date_end'], // db columns for start_date & end_date
                'label' => $label,
                'type' => 'date_range',
                // OPTIONALS
                // default values for start_date & end_date
                'default' => [Carbon::now()->setTimezone(session()->get('timezone') ?? 'UTC'), Carbon::now()->setTimezone(session()->get('timezone') ?? 'UTC')->addDays(2)],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'locale' => ['format' => 'MMM D, YYYY hh:mm a'],
                ],
            ],
        );

    }

    public static function timezone()
    {
        CRUD::addField([
            'name' => 'timezone',
            'type' => 'select2_from_array',
            'options' => \Timezone::getTimezones(),
        ]
        );

    }

    public static function currency()
    {
        CRUD::addField([
            'name' => 'currency_id',
            'type' => 'relationship',
            'attribute' => 'symbol',
        ]);
    }
    
    public static function countries()
    {
        CRUD::addField([
            'name' => 'country_id',
            'type' => 'relationship',
        ]);

    }

    public static function pulldownField($field)
    {
        CRUD::addField([
            'name' => $field,
            'options' => function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }

        ]);
    }

    public static function field($name = 'default', $type = 'text', $label = '', $hint)
    {
        CRUD::addField([
            'name' => $name,
            'type' => $type,
            'label' => $label === '' ? ucfirst($name) : $label,
            'hint' => $hint,
        ]);
    }

    public static function tags()
    {
        CRUD::addField(
            [
                'name' => 'fake_tags',
                'type' => 'view',
                'view' => 'tag_custom_selector',
            ]
        );

    }

    public static function date($name = null)
    {
        CRUD::addField([   // DateTime
                    'name' => $name ?? 'published_date',
                    'label' => 'Date',
                    'type' => 'datetime_picker',
                    'default' => 'now',
                    'datetime_picker_options' => [
                        'format' => 'MMM D, YYYY hh:mm a',
                        'tooltips' => [ //use this to translate the tooltips in the field
                            'selectDate' => 'Selecione a data',
                            // available tooltips: today, clear, close, selectMonth, prevMonth, nextMonth, selectYear, prevYear, nextYear, selectDecade, prevDecade, nextDecade, prevCentury, nextCentury, pickHour, incrementHour, decrementHour, pickMinute, incrementMinute, decrementMinute, pickSecond, incrementSecond, decrementSecond, togglePeriod, selectTime, selectDate
                        ],
                    ],
                    'allows_null' => false,
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ]);

    }

    public static function author()
    {
        $author = Author::where('user_id', backpack_user()->id)->first();
        CRUD::addField([
            'name' => 'author_id',
            'type' => 'select2',
            'attribute' => 'fullname',
            'value' => $author->id ?? null,
            'label' => 'Author',
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
        ]);
    }
    

}
