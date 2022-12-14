<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LevelRequest;
use App\Models\Event;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LevelCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LevelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\Level::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/level');
        CRUD::setEntityNameStrings('level', 'levels');
        $this->denyAccessIfNoPermission();

        if (request()->get('event') || session()->get('event_id')) {
            if (request()->get('event') !== null) {
                session()->put('event_id', request()->get('event'));
            }

            $getEvent = Event::where('id', session()->get('event_id'))->first();
            CRUD::setEntityNameStrings('level', $getEvent?->title.' Levels');
            customHeading('events', 'Levels', $getEvent?->title);
        } else {
            $this->crud->denyAccess('create');
        }

        $this->crud->query = $this->crud->query->where('event_id', session()->get('event_id'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->orderBy('level');
        $this->crud->disableResponsiveTable();
        $this->crud->addColumn([
            'name' => 'level',
            'type' => 'number',
        ]);
        CRUD::column('blinds');
        CRUD::column('ante');

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
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LevelRequest::class);

        $this->crud->addField([
            'name' => 'level',
            'description' => 'level',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'event_id',
            'type' => 'hidden',
            'value' => session()->get('event_id'),
        ]);

        $this->crud->addField([
            'label' => 'Small Blinds',
            'name' => 'small_blinds',
            'description' => 'Big Blinds',
            'type' => 'number',
            'attributes' => [
                'class' => 'form-control required'
            ],
            'wrapper' => [
                'class' => 'col-md-6 form-group'
            ]

        ]);


        $this->crud->addField([
            'label' => 'Big Blinds',
            'name' => 'big_blinds',
            'description' => 'Big Blinds',
            'type' => 'number',
            'attributes' => [
                'class' => 'form-control required'
            ],
              'wrapper' => [
                'class' => 'col-md-6 form-group'
            ]

        ]);

        $this->crud->addField([
            'label' => 'Ante',
            'name' => 'ante',
            'description' => 'ante',
            'type' => 'number',
        ]);

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
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
