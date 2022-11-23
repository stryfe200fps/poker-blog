<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\ArticleCategory;
use App\Services\BackpackUIService;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ArticleCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
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
        CRUD::setModel(\App\Models\Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/article');
        CRUD::setEntityNameStrings('article', 'articles');
        $this->crud->denyAccess('show');
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

        if (session()->get('new_article')) {
            $articleId = Article::find(session()->get('new_article'))->first()->slug;
            Widget::add()->to('before_content')->type('view')->view('vendor.backpack.custom.share')->slug($articleId); // widgets to show the ordering card
        }

        $this->crud->addButtonFromModelFunction('line', 'open_fb', 'shareFacebook', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_twitter', 'shareTwitter', 'beginning');

        $this->crud->addColumn([
            'name' => 'title',
            'type' => 'text',
            'limit' => 50,
            'wrapper' => [
                'href' => function ($entry, $column, $crud) {
                    return '/news/day/day/' . $crud->slug;
                },
            ],

        ]);

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
                'format' => config('app.date_format'),

            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        $this->crud->addFilter(
            [
                'type' => 'select2',
                'name' => 'article_categories',
                'label' => 'Category',
            ],
            function () {
                return ArticleCategory::all()->sortBy('title')->pluck('title', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('article_categories', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            }
        );
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
        $ui = new BackpackUIService();
        CRUD::setValidation(ArticleRequest::class);

        $userId = auth()->user()->id;

        $ui->title();
        $ui->slug();
        $ui->description();
        $ui->content('Main Content', 'main_content');
        $this->crud->addFields(
            [
                [
                    'name' => 'optional_content',
                    'label' => 'Content',
                    'type' => 'repeatable',
                    'new_item_label' => 'add section',
                    'subfields' => [
                        $ui->titleSubfield(),
                        $ui->contentSubfield('Content', 'body')
                    ],
                    'init_rows' => 0,
                ],

                [
                    'name' => 'article_categories',
                    'type' => 'select2_multiple',
                    'attribute' => 'title',
                    'label' => 'Categories',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],
                [   // DateTime
                    'name' => 'published_date',
                    'label' => 'Date',
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

            ]
        );

        $this->crud->addField(
            [
                'name' => 'fake_tags',
                'type' => 'view',
                'view' => 'tag_custom_selector',
            ]
        );


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
    }

    public function fetchTags()
    {
        return $this->fetch(
            [
                'model' => \App\Models\Tag::class,
                'paginate' => 3,
            ]
        );
    }

    public function store(Request $request)
    {
        $content = [
            0 =>
            [
                'title' => $request['title'],
                'body' => $request['main_content']
            ]
        ];

        if ($request['content'] !== null) {
            $content = array_merge($content, $request['content']);
        }

        $request['content'] = $content;


        return $this->traitStore();
    }

    public function update(Request $request)
    {
        $content = [
            0 =>
            [
                'title' => $request['title'],
                'body' => $request['main_content']
            ]
        ];

        if ($request['content'] !== null) {
            $content = array_merge($content, $request['content']);
        }
        $request['content'] = $content;

        return $this->traitUpdate();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        //     CRUD::column('title')->limit(-1);

        //    $content = $this->crud->getCurrentEntry()->content;

        //    dd($content);

        //     CRUD::column('content')->limit(50000000000)->type('function')->value(function ($ret) {

        //         return $ret;
        //     });
        $this->setupListOperation();
    }
}
