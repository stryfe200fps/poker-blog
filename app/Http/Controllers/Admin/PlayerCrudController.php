<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlayerRequest;
use App\Models\EventChip;
use App\Models\Player;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PlayerCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PlayerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\Player::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/player');
        CRUD::setEntityNameStrings('player', 'players');

        $this->crud->orderBy('name');
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
        $this->crud->orderBy('name');
        CRUD::column('name');
        CRUD::column('pseudonym');
        CRUD::column('country_id');
        // $this->crud->addButtonFromModelFunction('line', 'open_history', 'openHistory', 'beginning');

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'player',
            'label' => 'Country',
        ],

            function () {
                return Player::all()->pluck('country.name', 'country.id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->where('country_id', $values);
            }
        );
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
        CRUD::setValidation(PlayerRequest::class);

        CRUD::field('name');
        $this->crud->addField([
            'name' => 'avatar',
            'label' => 'Image',
            'type' => 'image',
            'aspect_ratio' => 1,
            'crop' => true,
        ]);
        CRUD::field('pseudonym');
        CRUD::field('country_id');

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
        $getChips = EventChip::where('player_id', $id)->count();

        if ($getChips) {
            return \Alert::error('This payer has event chips inside')->flash();
        }

        $this->crud->hasAccessOrFail('delete');
        $id = $this->crud->getCurrentEntryId() ?? $id;

        return $this->crud->delete($id);
    }
}
