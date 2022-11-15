<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChipCountRequest;
use App\Http\Requests\EventChipRequest;
use App\Models\Day;
use App\Models\Event;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class ChipCountCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChipCountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\EditableColumns\Http\Controllers\Operations\MinorUpdateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\EventChip::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/chip-count');
        CRUD::setEntityNameStrings('chip count', 'chip counts');

        if (request()->get('event') || session()->get('event_id')) {
            if (request()->get('event') !== null && request()->get('day') !== null) {
                session()->put('event_id', request()->get('event'));
                session()->put('event_day', request()->get('day'));
            }

            $getEvent = Event::where('id', session()->get('event_id'))->first();
            $getDay = Day::where('id', session()->get('event_day'))->first();
            CRUD::setEntityNameStrings('chip count', $getEvent?->title.' - Day: '.$getDay?->name);

            if ($getEvent === null) {
                \Alert::error('Dates is incorrect')->flash();

                return back();
            }
            $this->crud->query = $this->crud->query
            ->where('day_id', session()->get('event_day'))
            ->orderByDesc('published_date');
            customHeading('day?event='. $getEvent->id, 'Chip Counts', $getEvent?->title);

        } else {
            $this->crud->denyAccess('create');
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
        // $this->crud->addClause('join', 'event_reports', 'event_reports.id','=','event_chips.event_report_id' )
        // ->where('event_reports.id', session()->get('event_id'));
        // $this->crud->addClause('where', 'event_id', session()->get('event_id'));

        // $this->crud->addClause('where', 'event_report_id', '=', null);

        // 'chip_stacks' => collect(EventChipsResource::collection
        // ($this->latest_event_chips->sortByDesc('created_at')->unique('player_id')))->
        // sortByDesc('current_chips')->values()->all() ,

        $this->crud->addColumn([
            'name' => 'player_id',
            'type' => 'relationship',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->whereHas('player', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            },
        ]);
        // editable_switch

    //     CRUD::addColumn([
    //     'name'    => 'name',
    //     'label'   => 'Source',
    //     'type'    => 'editable_select',
    //     'options' => [ 'normal' => 'normal', 'whatsapp' => 'whatsapp' ],
    //     // or
    //     // 'options' => [
    //     //     '1' => 'One',
    //     //     '2' => 'Two',
    //     //     '3' => 'Three',
    //     // ],

    //     // Optionals
    //     'underlined'       => true, // show a dotted line under the editable column for differentiation? default: true
    //     'save_on_focusout' => true, // if user clicks out, the value should be saved (instead of greyed out)
    //     'save_on_change'   => true,
    //     'on_error' => [
    //         'text_color'          => '#df4759', // set a custom text color instead of the red
    //         'text_color_duration' => 0, // how long (in miliseconds) should the text stay that color (0 for infinite, aka until page refresh)
    //         'text_value_undo'     => false, // set text to the original value (user will lose the value that was recently input)
    //     ],
    //     'on_success' => [
    //         'text_color'          => '#42ba96', // set a custom text color instead of the green
    //         'text_color_duration' => 3000, // how long (in miliseconds) should the text stay that color (0 for infinite, aka until page refresh)
    //     ],
    //     'auto_update_row' => true, // update related columns in same row, after the AJAX call?
        // ]);

        // $this->crud->addColumn([
        //     'name' =>  'current_chips',
        //     'type' => 'text',
        //     'label' => 'chips'
        // ]);

        CRUD::addColumn([
            'name' => 'report',
            'type' => 'custom_html',
            'value' => function ($chip) {
                return $chip->event_report_id == null ? '' : '<a  href="/admin/report/'.$chip->event_report_id.'/edit">report</a>' ;
            } 
        ]);

        CRUD::addColumn([
            'name' => 'view',
            'type' => 'custom_html',
            'value' => function ($chip) {
                return $chip->event_report_id == null ? '' : '<a  href="/tours/view/view/view/update-'.$chip->event_report_id.'/">view</a>' ;
            } 
        ]);



        CRUD::addColumn([
            'name' => 'current_chips',
            'type' => 'editable_text',
            'label' => 'Chips',

            // Optionals
            'underlined' => true, // show a dotted line under the editable column for differentiation? default: true
            'min_width' => '120px', // how wide should the column be?
            'select_on_click' => false, // select the entire text on click? default: false
            'save_on_focusout' => false, // if user clicks out, the value should be saved (instead of greyed out)
            'on_error' => [
                'text_color' => '#df4759', // set a custom text color instead of the red
                'text_color_duration' => 0, // how long (in miliseconds) should the text stay that color (0 for infinite, aka until page refresh)
                'text_value_undo' => false, // set text to the original value (user will lose the value that was recently input)
            ],
            'on_success' => [
                'text_color' => '#42ba96', // set a custom text color instead of the green
                'text_color_duration' => 3000, // how long (in miliseconds) should the text stay that color (0 for infinite, aka until page refresh)
            ],
            'auto_update_row' => true, // update related columns in same row, after the AJAX call?
        ]);

        CRUD::addColumn([
            'name' => 'is_whatsapp',
            'label' => 'Whatsapp',
            'type' => 'editable_switch',
            'color' => 'success',
            'onLabel' => '✓',
            'offLabel' => '✕',
        ]);

        $this->crud->addColumn([
            'name' => 'published_date',
            'type' => 'datetime',
            'label' => 'Date',
        ]);

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
        CRUD::setValidation(EventChipRequest::class);

        $this->crud->addField([
            'type' => 'switch',
            'name' => 'is_whatsapp',
            'label' => 'Whatsapp source?',

        ]);

        $this->crud->addField([
            'name' => 'day_id',
            'type' => 'hidden',
            'label' => 'Player',
            'value' => session()->get('event_day'),
        ]);

        $this->crud->addField([
            'name' => 'player',
            'type' => 'relationship',
            'label' => 'Player',
        ]);

        $this->crud->addField([
            'name' => 'current_chips',
            'type' => 'text',
            'label' => 'Chips',
        ]);

        CRUD::addField(
            [
                'name' => 'published_date',
                'label' => 'Date',
                'type' => 'datetime_picker',
                'default' => 'now',
                'datetime_picker_options' => [
                    'format' => 'MMM D, YYYY hh:mm a',
                    'tooltips' => [ //use this to translate the tooltips in the field
                        'selectDate' => 'Selecione a data',
                    ],
                ],
                'allows_null' => false,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]
        );

        // $this->crud->addField([
        //     'name' =>  'current_chips',
        //     'type' => 'text'
        // ]);
        // CRUD::field('created_at');
        // CRUD::field('updated_at');

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

        $request = $this->crud->validateRequest();

        $this->crud->registerFieldEvents();

        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

        $this->data['entry'] = $this->crud->entry = $item;

        session()->flash('new_reports', $item->id);

        // \Alert::success('')->flash();

        \Alert::flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
}
