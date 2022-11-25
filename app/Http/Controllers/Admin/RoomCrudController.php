<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Requests\RoomRequest;
<<<<<<< HEAD
use App\Traits\LimitUserPermissions;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RoomCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RoomCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
<<<<<<< HEAD
    use LimitUserPermissions;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Room::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/room');
        CRUD::setEntityNameStrings('room', 'rooms');
<<<<<<< HEAD
        $this->denyAccessIfNoPermission();
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
        CRUD::column('country_id');
        CRUD::column('address');
        CRUD::column('phone');
        CRUD::column('website');

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'country_filter',
            'label' => 'Country',
        ],
            function () {
                return Country::all()->pluck('name', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('country', function ($query) use ($values) {
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RoomRequest::class);

        CRUD::field('title');
        $this->crud->addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder' => config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);
        CRUD::field('description')->type('textarea');

        $this->crud->addFields([
            [   // CKEditor
                'name' => 'content',
                'label' => 'Content',
                'type' => 'ckeditor',
                'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],

                'options' => [
                    'autoGrow_minHeight' => 200,
                    'autoGrow_bottomSpace' => 50,
                    'removePlugins' => 'resize,maximize',
                ],
            ], 
        ]);

        $this->crud->addField([
            'name' => 'country_id',
            'type' => 'relationship',

        ]);
        CRUD::field('address');
        CRUD::field('phone');
        CRUD::field('email')->type('email');
        CRUD::field('website');

        $this->crud->addField(
        [
                'name' => 'features',
                'label' => 'Features',
                'type' => 'repeatable',
                'attributes' => [
                    'id' => 'repeat',
                ],
                'new_item_label' => 'add feature',
                'subfields' => [
                    [
                        'label' => 'Feature',
                        'name' => 'feature',
                        'value' => '',
                        'type' => 'text',
                    ],
                    
                ],
                'init_rows' => 0,
            ]
        );



        $this->crud->addField([
            'name' => 'image',
            'type' => 'image',
            'aspect_ratio' => 3 / 2,
            'crop' => true,
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
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
