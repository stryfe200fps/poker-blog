<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Http\Requests\MediaReportingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MediaReportingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MediaReportingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
public function setup()
    {
        CRUD::setModel(\App\Models\MediaReporting::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/media-reporting');
        CRUD::setEntityNameStrings('media reporting', 'media reportings');

        // $this->crud->query = $this->crud->orderBy('published_date', 'DESC');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->orderBy('published_date', 'DESC');
        CRUD::addColumn('title');
        CRUD::addColumn('type');
        CRUD::addColumn('published_date');

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'author',
            'label' => 'Author',
        ],
            function () {
                return Author::all()->pluck('full_name', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('author', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            });

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */

    public function fetchMediaReportingCategories()
    {
        return $this->fetch(

            [
                'model' => \App\Models\MediaReportingCategory::class,
                'paginate' => 10,
                'searchOperator' => 'LIKE',
            ]
        );
    }

    protected function setupCreateOperation()
    {

        CRUD::setValidation(MediaReportingRequest::class);

        CRUD::addField('title');
        CRUD::addField([
                'label' => 'Type',
                'name' => 'type',
                'type' => 'select2_from_array',
                'options' => [
                    'video' => 'Video',
                    'podcast' => 'Podcast',
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-12  ',
                ],
            ]);
        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea'
        ]);

        // CRUD::addField(
        //              [
        //             'name' => 'media_reporting_categories',
        //             'type' => 'select2_multiple',
        //             'attribute' => 'title',
        //             'label' => 'Categories',
        //             'wrapper' => [
        //                 'class' => 'form-group col-md-12',
        //             ],
        //         ]
        //     );

        CRUD::addField(      [
                'label' => 'Categories',
                'type' => 'relationship',
                'name' => 'media_reporting_categories', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'media-reporting-category'],
                'ajax' => true,
                'minimum_input_length' => 0,
                'allows_null' => true,
                // 'value' => $this->crud->getCurrentOperation() === 'update' ? $this->crud->getCurrentEntry()->level->id : $lastLevelId,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);

        CRUD::addField('link');

        $author = Author::where('user_id', backpack_user()->id)->first();

        $this->crud->addField(

            [   // DateTime
                'name' => 'published_date',
                'label' => 'Published Date',
                'type' => 'datetime_picker',
                'default' => 'now',
                'datetime_picker_options' => [
                    'format' => 'MMM D, YYYY hh:mm a',
                    'tooltips' => [ //use this to translate the tooltips in the field
                        'today' => 'Hoje',
                        'selectDate' => 'Selecione a data',
                        // available tooltips: today, clear, close, selectMonth, prevMonth, nextMonth, selectYear, prevYear, nextYear, selectDecade, prevDecade, nextDecade, prevCentury, nextCentury, pickHour, incrementHour, decrementHour, pickMinute, incrementMinute, decrementMinute, pickSecond, incrementSecond, decrementSecond, togglePeriod, selectTime, selectDate
                    ],
                ],
                'allows_null' => false,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],

            ] );

        $this->crud->addField(

                [
                    'name' => 'image',
                    'type' => 'image',
                    'aspect_ratio' => 3 / 2,
                    'crop' => true,
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],
            );

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
