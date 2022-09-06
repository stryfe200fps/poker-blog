<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticleCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/article');
        CRUD::setEntityNameStrings('article', 'articles');
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
        CRUD::column('name');

        $this->crud->addColumns([
            [
                'name' => 'article_category', // the column that contains the ID of that connected entity;
                'label' => 'Experts', // Table column heading
                'type' => 'select',
            ],
        ]);
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
        CRUD::setValidation(ArticleRequest::class);

        $userId = auth()->user()->id;

        $this->crud->addFields(
            [

                [

                    'name' => 'name',
                    'label' => 'Name',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],

                ],
                [

                    'name' => 'description',
                    'body' => 'ckeditor',

                ],

                [
                    'label' => 'Category',
                    'type' => 'relationship',
                    'name' => 'article_category', // the method that defines the relationship in your Model
                    'allows_multiple' => false,
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [

                    'name' => 'description',
                    'body' => 'select_multiple',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],
                [   // CKEditor
                    'name' => 'body',
                    'label' => 'body',
                    'type' => 'ckeditor',
                    // optional:
                    // 'extra_plugins' => ['oembed', 'widget'],
                    'options' => [
                        'autoGrow_minHeight' => 200,
                        'autoGrow_bottomSpace' => 50,
                        'removePlugins' => 'resize,maximize',
                    ],
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],

                [
                    'name' => 'user_id',
                    'type' => 'hidden',
                    'value' => $userId,
                    'label' => 'author',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],

                ],

            ]
        );
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
