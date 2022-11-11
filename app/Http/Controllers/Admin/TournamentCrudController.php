<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TournamentRequest;
use App\Models\Tour;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\Tournament::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/series');
        CRUD::setEntityNameStrings('series', 'series');
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
        CRUD::column('title');
        CRUD::column('tour_id');

        $this->crud->addColumns([
            [
                'name' => 'date_start', // the column that contains the ID of that connected entity;
                'label' => 'Date Start', // Table column heading
                'type' => 'datetime',
                'format' => config('app.date_format'),
            ],
        ]);

        $this->crud->addColumns([
            [
                'name' => 'date_end', // the column that contains the ID of that connected entity;
                'label' => 'Date End', // Table column heading
                'type' => 'datetime',
                'format' => config('app.date_format'),
            ],
        ]);

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'tour_filter',
            'label' => 'Tours',
        ],
            function () {
                return Tour::all()->pluck('title', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('tour', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            });

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

        $this->crud->addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder' => config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);
        CRUD::field('description')->type('textarea');

        $this->crud->addFields([

            [   // CKEditor
                'name' => 'content',
                'label' => 'Content',
                'type' => 'ckeditor',
                'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],

                'options' => [
                    'autoGrow_minHeight' => 200,
                    'autoGrow_bottomSpace' => 50,
                    'removePlugins' => 'resize,maximize',
                ],
            ], ]);



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

        $this->crud->addFields([

            [   // date_range
                'name' => ['date_start', 'date_end'], // db columns for start_date & end_date
                'label' => 'Series Duration',
                'type' => 'date_range',

                // OPTIONALS
                // default values for start_date & end_date
                'default' => [Carbon::now()->setTimezone(session()->get('timezone') ?? 'UTC'), Carbon::now()->setTimezone(session()->get('timezone') ?? 'UTC')->addDays(2)],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'locale' => ['format' => 'MMM D, YYYY hh:mm a'],
                ],
            ],
 [
                'name' => 'image',
                'label' => 'Image',
                'type' => 'image',
                'aspect_ratio' => 3 / 2,
                'crop' => true,
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

    public function store(Request $request)
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // $date  = \Carbon\Carbon::parse($request->get('date_start'), session()->get('timezone') ?? 'UTC') ;
        // $request['date_start'] = $date->setTimezone('UTC');

        // $date2  = \Carbon\Carbon::parse($request->get('date_end'), session()->get('timezone') ?? 'UTC') ;
        // $request['date_end'] = $date2->setTimezone('UTC');

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
