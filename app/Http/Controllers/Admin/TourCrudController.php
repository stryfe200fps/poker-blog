<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TourRequest;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TourCrudController extends CrudController
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
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\Tour::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/poker-tour');
        CRUD::setEntityNameStrings('tour', 'tours');
        $this->denyAccessIfNoPermission();
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
        $this->crud->disableResponsiveTable();
        CRUD::column('title');
        CRUD::column('description');


   



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
        CRUD::setValidation(TourRequest::class);

        CRUD::field('title');

        $this->crud->addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder' => config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);

        CRUD::field('description');
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
    ], ]);
        $this->crud->addFields([[
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 3 / 2,
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
        ],
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

    public function destroy($id)
    {
        if ($this->crud->getCurrentEntry()->tournaments->count()) {
            return \Alert::error('This tour has tournaments inside')->flash();
        }

        $this->crud->hasAccessOrFail('delete');
        $id = $this->crud->getCurrentEntryId() ?? $id;

        return $this->crud->delete($id);
    }
}
