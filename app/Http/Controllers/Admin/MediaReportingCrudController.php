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
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
        CRUD::addColumn('title');

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
        CRUD::addField('link');

        $author = Author::where('user_id', backpack_user()->id)->first();

        if ($author !== null) {
            $this->crud->addField([
                'name' => 'author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'value' => $author->id,
                'label' => 'Author',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
        } else {
            $this->crud->addField([
                'name' => 'author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'label' => 'Author',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
        }

        $this->crud->addField(

            [   // DateTime
                'name' => 'published_date',
                'label' => 'Date',
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
