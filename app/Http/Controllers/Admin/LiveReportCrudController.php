<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LiveReportRequest;
use App\Models\LiveReport;
use App\Models\LiveReportPlayer;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;
use DateTime;
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
        CRUD::column('title');
        $this->crud->addColumns([
            [
                'name' => 'players',
                'type' => 'select2',
                'attributes' => 'player_name'
            ],
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

        CRUD::field('title');
        $this->crud->addFields([

            [   // CKEditor
                'name' => 'content',
                'label' => 'Content',
                'type' => 'ckeditor',
                // optional:
                'options' => [
                    'autoGrow_minHeight' => 200,
                    'autoGrow_bottomSpace' => 50,
                    'removePlugins' => 'resize,maximize',
                ],
            ],

            [
                'name' => 'poker_event_id',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [   // DateTime
                'name' => 'date_added',
                'label' => 'Date',
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
                'default' => Carbon::now()->toDateTimeString(),
                'allows_null' => true,
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],

            ],
            [
                'label' => 'Media',
                'name' => 'divider',
                'type' => 'custom_html',
                'value' => '<b>Media</b>'
            ],
            [   
                'label' => 'Image',
                'name' => 'featured_image',
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name' => 'image_caption',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],

            
            [
                'name' => 'players',
                //chip stack
                'label' => 'Chip Counts',
                'type' => 'repeatable',
                'new_item_label' => 'add stack',
                'tab' => 'Chip Stack',
                'subfields' => [
                    [   //image
                        'label' => 'Player',
                        'name' => 'player_name',
                        'model' => 'App\Models\Player',
                        'attribute' => 'name',
                        'type' => 'select2',
                    ],
                    [   //image
                        'label' => 'Chips',
                        'name' => 'chips',
                        'type' => 'number',
                        'value' => 0
                    ],
                ],
                'init_rows' => 1
            ],
        ]);

        Widget::add()->type('script')->content('assets/js/admin/forms/chip_count.js');

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

           $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
           $this->data['entry'] = $this->crud->entry = $item;

           foreach ($request->get('players') as $player) {
               $liveReportPlayer = new LiveReportPlayer();
               $liveReportPlayer->name = $player['player_name'];
               $liveReportPlayer->current_chips = $player['chips'];
               $liveReportPlayer->chips_before = 0;
               $liveReportPlayer->save();
               $item->liveReportPlayers()->attach($liveReportPlayer);
           }

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
