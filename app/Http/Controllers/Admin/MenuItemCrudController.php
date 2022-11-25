<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuItemRequest;
use Illuminate\Http\Request;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class MenuItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use LimitUserPermissions;

    public function setup()
    {
        $this->crud->setModel("Backpack\MenuCRUD\app\Models\MenuItem");
        $this->crud->setRoute(config('backpack.base.route_prefix').'/menu-item');
        $this->crud->setEntityNameStrings('menu-item', 'menu items');

        $this->denyAccessIfNoPermission();

        $this->crud->enableReorder('name', 3);

        $this->crud->operation('list', function () {
            $this->crud->addColumn([
                'name' => 'name',
                'label' => 'Label',
            ]);
            $this->crud->addColumn([
                'label' => 'Parent',
                'type' => 'select',
                'name' => 'parent_id',
                'entity' => 'parent',
                'attribute' => 'name',
                'model' => "\Backpack\MenuCRUD\app\Models\MenuItem",
            ]);
        });

        $this->crud->operation(['create', 'update'], function () {

            $this->crud->setValidation(MenuItemRequest::class);
            $this->crud->addField([
                'name' => 'name',
                'label' => 'Label',
            ]);
            // $this->crud->addField([
            //     'label' => 'Parent',
            //     'type' => 'select',
            //     'name' => 'parent_id',
            //     'entity' => 'parent',
            //     'attribute' => 'name',
            //     'model' => "app\Models\MenuItem",
            //     'view_namespace' => file_exists(resource_path('views/vendor/backpack/crud/fields/menu_parent_selector.blade.php')) ? null : 'menucrud::fields',

            // ]);
            $this->crud->addField(
                   [
                'name' => 'parent_id',
                'type' => 'view',
                'view' => 'menu_parent_selector' 
                ]
            );
            $this->crud->addField([
                'name' => ['type', 'link', 'page_id'],
                'label' => 'Type',
                'type' => 'page_or_link',
                'page_model' => 'app\Models\Page',
                'view_namespace' => file_exists(resource_path('views/vendor/backpack/crud/fields/page_or_link.blade.php')) ? null : 'menucrud::fields',
            ]);
        });
    }



    // public function store(Request $request)
    // {
    //     $this->crud->hasAccessOrFail('create');

    //     // execute the FormRequest authorization and validation, if one is required
    //     $request = $this->crud->validateRequest();

    //     // $date  = \Carbon\Carbon::parse($request->get('date_start'), session()->get('timezone') ?? 'UTC') ;
    //     // $request['date_start'] = $date->setTimezone('UTC');

    //     // $date2  = \Carbon\Carbon::parse($request->get('date_end'), session()->get('timezone') ?? 'UTC') ;
    //     // $request['date_end'] = $date2->setTimezone('UTC');

    //     // register any Model Events defined on fields
    //     $this->crud->registerFieldEvents();

    //     $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

    //     dd($item);


    //     // dd($request->get('published_date'), $request->get('timezone'));
    //     // $this->attributes['published_date'] = $date->setTimezone('UTC');
    //     // $item->setAttribute('timezone', $request['timezone']);

    //     $this->data['entry'] = $this->crud->entry = $item;

    //     // session()->put('new_article', 'a new article');

    //     session()->flash('new_article', $item->id);

    //     \Alert::success(trans('backpack::crud.insert_success'))->flash();

    //     $this->crud->setSaveAction();

    //     return $this->crud->performSaveAction($item->getKey());
    // }

}
