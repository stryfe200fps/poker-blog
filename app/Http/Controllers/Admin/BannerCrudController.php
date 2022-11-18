<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerRequest;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BannerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Banner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/banner');
        CRUD::setEntityNameStrings('banner', 'banners');
        $this->denyAccessIfNoPermission();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->orderBy('id', 'DESC');
        CRUD::column('name');
        CRUD::column('location');
        CRUD::column('url');
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
        CRUD::setValidation(BannerRequest::class);

        CRUD::field('name');

        CRUD::field('url');
        $this->crud->addField([
                'label' => 'Location',
                'name' => 'location',
                'type' => 'select2_from_array',
                'options' => [
                    'home-background-full' => 'home-background-full',
                    'home-background-full-1600' => 'home-background-full-1600',
                    'home-top-landscape' => 'home-top-landscape',
                    'home-column-square' => 'home-column-square',
                    'reporting-background-full' => 'reporting-background-full',
                    'reporting-background-full-1600' => 'reporting-background-full-1600',
                    'reporting-top-landscape' => 'reporting-top-landscape',
                    'reporting-column-square' => 'reporting-column-square'
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
        ]);

        $this->crud->addField(

                [
                    'name' => 'image',
                    'type' => 'image',
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
