<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PayoutRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventPayout;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Http\Request;

/**
 * Class PayoutCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PayoutCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\EditableColumns\Http\Controllers\Operations\MinorUpdateOperation;
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\EventPayout::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payout');

        if (request()->get('event') || session()->get('payout_event_id')) {
            if (request()->get('event') !== null) {
                session()->put('payout_event_id', request()->get('event'));
            }

            $getEvent = Event::where('id', session()->get('payout_event_id'))->first();


            CRUD::setEntityNameStrings('payouts', 'payouts');
            if ($getEvent?->title !== null) {
                customHeading('events', 'Payouts', $getEvent?->title);
            }

            // $this->crud->addFilter($options, $values, $filter_logic);
        } else {
            $this->crud->denyAccess('create');
        }
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

        $this->crud->addClause('where', 'event_id', session()->get('payout_event_id'));
        $this->crud->orderBy('position');

        $this->crud->addColumn([
            'name' => 'player_id',
            'type' => 'relationship',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->whereHas('player', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        CRUD::addColumn([
            'name' => 'prize',
            'type' => 'editable_text',
            'label' => 'Prize',

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
            'name' => 'position',
            'type' => 'editable_text',
            'label' => 'Position',

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
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('position', 'ASC');
            },

        ]);

        Widget::add()->to('after_content')->type('view')->view('vendor.backpack.helper.payout')->eventId(session()->get('payout_event_id'))->modelName(addslashes(get_class($this->crud->model)));; // widgets to show the ordering card

        // $this->crud->addFilter([
        //     'type' => 'select2',
        //     'name' => 'player',
        //     'label' => 'Country',
        // ],

        //     function () {
        //         return Country::all()->pluck('name', 'id')->toArray();
        //     },
        //     function ($values) {
        //         $this->crud->query = $this->crud->query->where('event_id', session()->get('payout_event_id'))->whereHas('player', function ($query) use ($values) {
        //             $query->whereHas('country', function ($countryQuery) use ($values) {
        //                 $countryQuery->where('id', $values);
        //             });
        //             // $query->where('id', $values);
        //         });
        //     }
        // );

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupCreateOperation()
    {
        if (session()->get('payout_event_id') >= 1) {
            $this->crud->allowAccess('create');
        }

        CRUD::setValidation(PayoutRequest::class);
        $this->crud->addField([
            'type' => 'hidden',
            'value' => session()->get('payout_event_id'),
            'name' => 'event_id',
        ]);

        $this->crud->addField([
            'name' => 'player',
            'label' => 'Player',
            'type' => 'relationship',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'position',
            'label' => 'Position',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'prize',
            'label' => 'Prize',
            'type' => 'number',
        ]);

        // $this->crud->addField([
        //     'name' => 'source',
        //     'label' => 'Source',
        //     'type' => 'select2_from_array',
        //     'value' => 'normal',
        //     'options' => [
        //         'normal' => 'normal',
        //         'whatsapp' => 'whatsapp',
        //     ],
        // ]);
    }

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

        $currentId = session()->get('payout_event_id');
        // dd($currentId);
        $currentRequest = $this->crud->getStrippedSaveRequest($request);

        $payout = EventPayout::where('player_id', $currentRequest['player'] ?? 0)
            ->where('event_id', $currentId);

        if ($payout->count()) {
            $payout = $payout->first();
            $payout->prize = $currentRequest['prize'];
            $payout->position = $currentRequest['position'];
            $payout->save();

            \Alert::success(trans('backpack::crud.insert_success'))->flash();

            return $this->crud->performSaveAction($payout->id);
        } else {
            $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
            $this->data['entry'] = $this->crud->entry = $item;

            \Alert::success(trans('backpack::crud.insert_success'))->flash();

            return $this->crud->performSaveAction($item->getKey());
        }

        //  return redirect()->route('mymodel.picture.index',
        //     [
        //         'id' => 20
        //     ]);
        // return $response;
    }
}
