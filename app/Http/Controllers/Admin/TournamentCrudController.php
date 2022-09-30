<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TournamentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

/**
 * Class
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TournamentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tournament::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/poker-tournament');
        CRUD::setEntityNameStrings('poker tournament', 'poker tournaments');
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
        CRUD::column('title');
        CRUD::column('description');
        CRUD::column('tour_id');
        CRUD::column('date_start');
        CRUD::column('date_end');

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
        CRUD::setValidation(TournamentRequest::class);
        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->addDays(2)->toDateTimeString();

        CRUD::field('tour_id')->options(function ($query) {
            return $query->orderBy('title', 'ASC')->get();
        });

        CRUD::field('title');
        CRUD::field('description');

        $this->crud->addField([
            'name' => 'currency_id',
            'type' => 'relationship',
            'attribute' => 'symbol',
        ]);

        $this->crud->addField([
            'name' => 'country_id',
            'type' => 'relationship',

        ]);

        $this->crud->addField([
            'name' => 'timezone',
            'type' => 'select2_from_array',
            'options' => \Timezone::getTimezones(),
        ]
        );

        $this->crud->addField([
            'name' => 'timezone',
            'type' => 'select2_from_array',
            'options' => \Timezone::getTimezones(),
        ]
        );

        $this->crud->addFields([

            [
                'name' => 'image',
                'label' => 'image',
                'type' => 'image',
                'aspect_ratio' => 3 / 2,
                'crop' => true,
            ],
            [   // date_range
                'name' => ['date_start', 'date_end'], // db columns for start_date & end_date
                'label' => 'Tournament Duration',
                'type' => 'date_range',

                // OPTIONALS
                // default values for start_date & end_date
                'default' => [$start, $end],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'locale' => ['format' => 'DD/MM/YYYY HH:mm'],
                ],
            ],

        ]);

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

        if ($this->crud->getCurrentEntry()->events->count()) {
            return \Alert::error('This tournament has events inside')->flash();
        }

        $this->crud->hasAccessOrFail('delete');
        $id = $this->crud->getCurrentEntryId() ?? $id;
        return $this->crud->delete($id);
    }
}
