<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Http\Requests\MediaReportingRequest;
use App\Models\MediaReportingCategory;
use App\Services\BackpackUIService;
use App\Traits\LimitUserPermissions;
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
    use LimitUserPermissions;

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
        $this->denyAccessIfNoPermission();

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
        $ui = new BackpackUIService();

        CRUD::field('show_homepage')->type('switch')->label('Should be on homepage');
        $ui->title();
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
        $ui->description();
        CRUD::addField([
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

        $ui->date();
        $ui->image();


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
