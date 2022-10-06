<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Library\Widget;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

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

        $this->crud->addColumns([
            [
                'name' => 'published_date', // the column that contains the ID of that connected entity;
                'label' => 'Date', // Table column heading
                'type' => 'datetime',
                'format' => config('app.date_format')

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

        //working with cancelation

// $this->crud->addField([
//     'name' => 'datepicker',
//     'type' => 'date_range',
//     'label' => "Start Date",
//     'wrapperAttributes'=>['class'=>'form-group col-md-6'],
//     //'default' => [date("Y-m-d"), date("Y-m-d")],
//     'date_range_options' => [
//         'todayBtn' => 'linked',
//         // options sent to daterangepicker.js
//         'timePicker' => true,
//         'startDate' => date("Y-m-d"),
//         'endDate' => date("Y-m-d"),
//         'minDate'=> date("Y-m-d"),
//         'locale' => ['format' => 'YYYY-MM-DD']
//     ],
//     'allows_null' => true,
// ]);

        // $this->crud->addField([
        //     'name' => 'timezone',
        //     'attribute' => "timezone", 
        //     'tab' => 'Basic',
        //     'type' => 'text'
        // ]);

        $this->crud->addFields(
            [
                [
                    'name' => 'title',
                    'label' => 'Title',
                    'tab' => 'Basic',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],
            [
                        'name' => 'slug',
                        'type' => 'text',
        'attributes' => [
                'placeholder'=> config('app.slug_placeholder'),
            ],
                        'tab' => 'Basic'
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
                ] ,
                // [
                //     'name' => 'tags',
                //     'type' => 'relationship',
                //     'attribute' => 'title',
                //     'label' => 'Tags',
                //     'tab' => 'Basic',
                //     'wrapper' => [
                //         'class' => 'form-group col-md-12',
                //     ],
                // ],

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
                [   // DateTime
                'name' => 'published_date',
                'label' => 'Date',
                'tab' => 'Basic',
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

            ],
                [
                'label' => 'Tags',
                'type' => 'relationship',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'tag'],
                'ajax' => true,
                   'minimum_input_length' => 0,
                'allows_null' => true,
                'tab' => 'Basic',
                // 'value' => $this->crud->getCurrentOperation() === 'update' ? $this->crud->getCurrentEntry()->level->id : $lastLevelId,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
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
                'label' => 'Author',
                'tab' => 'Basic',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
        }
        // Widget::add()->type('script')->content('assets/js/admin/date/modify_datepicker.js');
    }


public function fetchTags()
{
    return $this->fetch(\App\Models\Tag::class);
}


public function store(Request $request)
{
    $this->crud->hasAccessOrFail('create');

    // execute the FormRequest authorization and validation, if one is required
    $request = $this->crud->validateRequest();


    // $date  = \Carbon\Carbon::parse($request->get('published_date'), $request->get('timezone')) ?? 'UTC' ;
    // $request['published_date'] = $date->setTimezone('UTC');

    // register any Model Events defined on fields
    $this->crud->registerFieldEvents();

    $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

    // dd($request->get('published_date'), $request->get('timezone'));
    // $this->attributes['published_date'] = $date->setTimezone('UTC');
    // $item->setAttribute('timezone', $request['timezone']);

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
