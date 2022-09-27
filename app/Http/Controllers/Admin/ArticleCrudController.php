<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Http\Request;

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
        $this->crud->denyAccess('show');
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
        if (session()->get('new_article')) {
            $articleId = Article::find(session()->get('new_article'))->first()->slug;
            Widget::add()->to('before_content')->type('view')->view('vendor.backpack.custom.share')->slug($articleId); // widgets to show the ordering card
        }

        CRUD::column('title');

        CRUD::column('slug');
        $this->crud->addColumns([
            [
                'name' => 'article_categories', // the column that contains the ID of that connected entity;
                'label' => 'Category', // Table column heading
                'type' => 'select',
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'article_categories',
            'label' => 'Poker Event',
        ],
            function () {
                return ArticleCategory::all()->pluck('title', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('article_category', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            });
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
                    'name' => 'title',
                    'label' => 'Title',
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
                    'name' => 'article_categories',
                    'type' => 'select2_multiple',
                    'attribute' => 'title',
                    'label' => 'Categories',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ] ,[
                    'name' => 'article_tags',
                    'type' => 'relationship',
                    'attribute' => 'title',
                    'label' => 'Tags',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
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
                    'label' => 'Content',
                    'type' => 'ckeditor',
                    'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
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
                    'name' => 'published_date',
                    'type' => 'datetime_picker',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                    'date_picker_options' => [
                        'todayBtn' => 'linked',
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                [
                    'name' => 'image',
                    'type' => 'image',
                    'aspect_ratio' => 3 / 2,
                    'crop' => true,
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],

            ]
        );

 
        $author = ArticleAuthor::where('user_id', backpack_user()->id)->first();
      
        if ($author !== null) {
            $this->crud->addField([
                'name' => 'article_author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'value' => $author->id,
                'label' => 'Author',
                'tab' => 'Basic',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
        } else {
            $this->crud->addField([
                'name' => 'article_author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'label' => 'author',
                'tab' => 'Basic',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
        }
    }

public function store(Request $request)
{
    $this->crud->hasAccessOrFail('create');

    // execute the FormRequest authorization and validation, if one is required
    $request = $this->crud->validateRequest();

    // register any Model Events defined on fields
    $this->crud->registerFieldEvents();

    $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
    $this->data['entry'] = $this->crud->entry = $item;

    // session()->put('new_article', 'a new article');

    session()->flash('new_article', $item->id);

    \Alert::success(trans('backpack::crud.insert_success'))->flash();

    $this->crud->setSaveAction();

    return $this->crud->performSaveAction($item->getKey());
}

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
