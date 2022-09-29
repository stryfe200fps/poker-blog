<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use Backpack\CRUD\app\Library\Widget;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class 
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/events');
        CRUD::setEntityNameStrings('events', 'events');

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
        CRUD::column('tournament');
        CRUD::column('date_start');
        CRUD::column('date_end');
        $this->crud->addButtonFromModelFunction('line', 'open_payout', 'openPayout', 'beginning');
        // $this->crud->addButtonFromModelFunction('line', 'open_chip_count', 'openChipCount', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_google', 'openLiveReporting', 'beginning');
    }

     /**
      * Define what happens when the Create operation is loaded.
      *
      * @see https://backpackforlaravel.com/docs/crud-operation-create
      *
      * @return void
      */
     public function nowItIsFlat($arr)
     {
         $output = [];
         foreach ($arr as $key => $val) {
             if (is_array($val)) {
                 $output[array_key_first($val)] = $val[array_key_first($val)];
             } else {
                 $output[array_key_first($val)] = $val[array_key_first($val)];
             }
         }

         return $output;
     }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EventRequest::class);
        CRUD::field('title');

        $this->crud->addField([
                'name' => 'slug',
                'type' => 'text'
        ]);

        CRUD::field('description');
        $this->crud->addField([

            'name' => 'image',
            'type' => 'image',
            'aspect_ratio' => 3 / 2,
            'crop' => true,

        ]);

        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->addDays(1)->toDateTimeString();
        $pokerTours = Tour::all();

        $this->crud->addFields([

            [   // date_range
                'name' => ['date_start', 'date_end'], // db columns for start_date & end_date
                'label' => 'Event Duration',
                'type' => 'date_range',

                'default' => [$start, $end],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'maxDate'  => $end,
                    'locale' => ['format' => 'DD/MM/YYYY HH:mm'],
                ],
            ],
        ]);

  

        $this->crud->addField([   // select2_from_array
            'name' => 'tournament_id',
            'label' => 'Tournament',
            'type' => 'relationship',
            'entity' => 'tournament',
            'attribute' => 'parent',
            'allows_null' => false,
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),

            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);


        $this->crud->addField([
        'name' => 'schedule',
        'label' => 'Schedule',
        'type' => 'repeatable',
        'new_item_label' => 'add day',
        'tab' => 'Days',
        'subfields' => [
            
            [
                'label' => 'Day',
                'tooltip' => 'example: 1A',
                'name' => 'title',
                'type' => 'text',
                'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            ],

            [   // date_range
                'name' => ['date_start', 'date_end'], // db columns for start_date & end_date
                'label' => 'Day Duration',
                'type' => 'date_range',
        'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
                'default' => [$start, $end],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'locale' => ['format' => 'DD/MM/YYYY HH:mm'],
                ],
            ],

            
        ],
        'init_rows' => 0,
    ],
);


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
        $id = 0;
        if ($this->crud->getCurrentEntryId()) {
            $id = $this->crud->getCurrentEntryId();
            session()->put('event_id', $id);
        } else {
            $id = session()->put('event_id', $id);
        }
        $this->setupCreateOperation();
        Widget::add()->to('after_content')->type('view')->view('vendor.backpack.helper.excel.uploader')->eventId($id); // widgets to show the ordering card
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

        // dd(request()->all());
        // session()->flash('new_reports', $item->id);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());

        //  return redirect()->route('mymodel.picture.index',
    //     [
    //         'id' => 20
    //     ]);
        // return $response;
    }
}
