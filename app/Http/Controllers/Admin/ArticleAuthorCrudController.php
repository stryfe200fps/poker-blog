<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleAuthorRequest;
use App\Models\User;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Exception;
use Illuminate\Http\Request;

/**
 * Class ArticleAuthorCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleAuthorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ArticleAuthor::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/article-author');
        CRUD::setEntityNameStrings('author', 'authors');
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
        $this->crud->addColumn([

            'label' => 'Image',
            'name' => 'avatar',
            'type' => 'image',
            'crop' => false,

        ]);
        CRUD::column('first_name');
        CRUD::column('last_name');
        CRUD::column('user_id');

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
        CRUD::setValidation(ArticleAuthorRequest::class);

        CRUD::field('first_name');
        CRUD::field('last_name');
        $this->crud->addField([
            'label' => 'Image',
            'name' => 'avatar',
            'type' => 'image',
            'crop' => 'true',
            'aspect_ratio' => 1,
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'description',
            'label' => 'Content',
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
            // optional:
            'options' => [
                'autoGrow_minHeight' => 200,
                'autoGrow_bottomSpace' => 50,
                'removePlugins' => 'resize,maximize',
            ],
        ], );

        if ($this->crud->getCurrentOperation() == 'update') {
            $this->crud->addField([
                'hint' => 'note: Create an account first',
                'name' => 'user_id',
                'type' => 'select2',
                'attribute' => 'email',
                'value' => $this->crud->getCurrentEntry()->user_id,
                'options' => (function ($query) {
                    return $query
                    ->where('article_author_id', '=', 0)
                    ->orWhere('article_author_id', '=', null)
                    ->orWhere('id', $this->crud->getCurrentEntry()->user_id)
                    ->get();
                }),
            ]);
        } else {
            $this->crud->addField([
                'hint' => 'note: Create an account first',
                'name' => 'user_id',
                'type' => 'select2',
                'attribute' => 'email',
                'options' => (function ($query) {
                    return $query->where('article_author_id', '=', 0)->orWhere('article_author_id', '=', null)->get();
                }),
            ]);
        }

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

    public function store(Request $request)
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
        $this->data['entry'] = $this->crud->entry = $item;

        if ($item->user_id) {
            $user = User::find($item->user_id);
            $user->article_author_id = $item->id;
            $user->assignRole('author');
            $user->save();
        }
        // session()->flash('new_article', $item->id);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

      public function update()
      {
          $this->crud->hasAccessOrFail('update');

          // execute the FormRequest authorization and validation, if one is required
          $request = $this->crud->validateRequest();

          // register any Model Events defined on fields
          $this->crud->registerFieldEvents();

          // update the row in the db
          $item = $this->crud->update(
              $request->get($this->crud->model->getKeyName()),
              $this->crud->getStrippedSaveRequest($request)
          );
          $this->data['entry'] = $this->crud->entry = $item;

          try {
          } catch (Exception $e) {
          }

          if ($item->user_id) {
              $user = User::find($item->user_id);
              $user->article_author_id = $item->id;
              $user->assignRole('author');
              $user->save();
          } else {
              $user = User::where('article_author_id', $this->crud->getCurrentEntryId())->first();
              $user->article_author_id = 0;
              $user->update();
          }
          // else {

          // dd($user);
          // $user->article_author_id = null;
          // $user->removeRole('author');
          // $user->save();

          // }

          // show a success message
          \Alert::success(trans('backpack::crud.update_success'))->flash();

          // save the redirect choice for next time
          $this->crud->setSaveAction();

          return $this->crud->performSaveAction($item->getKey());
      }
}
