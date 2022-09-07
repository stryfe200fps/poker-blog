<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LiveReportRequest;
use App\Models\LiveReport;
use App\Models\LiveReportPlayer;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class LiveReportCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LiveReportCrudController extends CrudController
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
        CRUD::setModel(\App\Models\LiveReport::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/live-report');
        CRUD::setEntityNameStrings('live report', 'live reports');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }


    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('body');
        CRUD::column('description');
        $this->crud->addColumns([
            [
                'name' => 'players',
            ]
        ]);
        // CRUD::column('event_schedule_id');
        // CRUD::column('image_caption');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(LiveReportRequest::class);

        CRUD::field('name');
        $this->crud->addFields([

            [   // CKEditor
                'name' => 'description',
                'label' => 'body',
                'type' => 'ckeditor',
                // optional:
                'options' => [
                    'autoGrow_minHeight' => 200,
                    'autoGrow_bottomSpace' => 50,
                    'removePlugins' => 'resize,maximize',
                ],
            ],

            [   // DateTime
                'name' => 'date_added',
                'label' => 'Event start',
                'type' => 'datetime_picker',

                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'tooltips' => [ //use this to translate the tooltips in the field
                        'today' => 'Hoje',
                        'selectDate' => 'Selecione a data',
                        // available tooltips: today, clear, close, selectMonth, prevMonth, nextMonth, selectYear, prevYear, nextYear, selectDecade, prevDecade, nextDecade, prevCentury, nextCentury, pickHour, incrementHour, decrementHour, pickMinute, incrementMinute, decrementMinute, pickSecond, incrementSecond, decrementSecond, togglePeriod, selectTime, selectDate
                    ],
                ],
                'allows_null' => true,
                // 'default' => '2017-05-12 11:59:59',
            ],

             [   //image
                'label' => 'Image',
                'name' => 'featured_image',
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
                // 'prefix'        => 'public/img/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            ],
            [
                'name' => 'players',
                'label' => 'Players',
                'type' => 'repeatable',
                'new_item_label' => 'add player',
                'tab' => 'Player',
                'subfields' => [
                    [   //image
                        'label' => 'player',
                        'name' => 'player_name',
                        'options' => [
                            'default' => '-',
                            'p1' => 'Player 1',
                            'p2' => 'Player 2',
                            'p3' => 'Player 3',
                        ],
                        'type' => 'select_from_array',
                    ],
                    [   //image
                        'label' => 'chips',
                        'name' => 'chips',
                        'type' => 'text',
                    ],
                ],
            ],
        ]);
        CRUD::field('event_schedule_id');
        CRUD::field('image_caption');


        if ($this->crud->getCurrentOperation() === 'update') {
            $liveReport = LiveReport::find($this->crud->getCurrentEntryId());
            $players = collect($liveReport->liveReportPlayers);
        }
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

           // insert item in the db
           $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
           // dd($request);
           $this->data['entry'] = $this->crud->entry = $item;

           foreach ($request->get('players') as $player) {
               $liveReportPlayer = new LiveReportPlayer();
               $liveReportPlayer->name = $player['player_name'];
               $liveReportPlayer->current_chips = $player['chips'];
               $liveReportPlayer->chips_before = 0;
               $liveReportPlayer->save();
               $item->liveReportPlayers()->attach($liveReportPlayer);
           }

          

            // dd($request->get('logo'), $logo);


           // collect($request->get('gallery'))
        //     ->filter(fn ($image) => $image['gallery'] != null && $image != '')
        //     ->map(fn ($image) => $item->addMediaFromBase64($image['gallery'])
        //     ->usingFileName(uniqid().'.jpg')
        //     ->toMediaCollection('media'));

           // $extracted = collect($request->all())->filter(fn ($item, $val) => str_contains($val, 'category'));
           // $item->categories()->attach($extracted);

           // show a success message
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
