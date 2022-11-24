<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\ArticleCategory;
use App\Services\BackpackFilterService;
use App\Services\BackpackTableService;
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

        (new BackpackTableService())->title(fn ($entry, $column, $crud) => '/news/day/day/'. $crud->slug );
        
        CRUD::column('article_categories')->label('Category');
        CRUD::column('published_date')->label('Date')->format(config('app.date_format')); 
         (new BackpackFilterService())->articleCategories($this);
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
        $ui = new BackpackUIService();
        CRUD::setValidation(ArticleRequest::class);

        $ui->title();
        $ui->slug();
        $ui->description();
        $ui->content('Main Content', 'main_content');
        CRUD::field('content')->label('Content')->type('repeatable')->subfields([
            $ui->titleSubfield(),
            $ui->contentSubfield('Content', 'body')
        ])->init_rows(0)->new_item_label('add section');

        CRUD::field('article_categories')->type('select2_multiple')->attribute('title')->label('Categories');
        $ui->date();
        $ui->author();
        $ui->image();

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

}
