<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Tournament;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LiveCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LiveCrudController extends CrudController
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
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('create');
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/live');
        CRUD::setEntityNameStrings('report', 'Live Poker Event');
        CRUD::denyAccess('create');
        $this->denyAccessIfNoPermission();

        $allLiveEvents = collect(Event::all())
            ->filter(fn ($arr) => $arr->status() == 'live'
            );

        if (!count($allLiveEvents))
            $this->crud->addClause('where', function ($q) {
                $q->where('id', 0);
            });

            foreach ($allLiveEvents as $live) {
                $this->crud->addClause('orWhere', function ($query) use ($live) {
                    $query->orWhere('id', $live->id);
                });
            } 

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
        CRUD::column('title')->limit(100);
        CRUD::column('tournament.title')->label('Series')->limit(100);


        $this->crud->addButtonFromModelFunction('line', 'openLevel', 'openLevel', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_payout', 'openPayout', 'beginning');
        // $this->crud->addButtonFromModelFunction('line', 'open_chip_count', 'openChipCount', 'beginning');
        // TODO: Chips should be part of days
           $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'tournament',
            'label' => 'Series',
        ],
            function () {
                return Tournament::all()->sortBy('title')->pluck('title', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('tournament', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            });


        $this->crud->addButtonFromModelFunction('line', 'days', 'openDay', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::field('id');
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
