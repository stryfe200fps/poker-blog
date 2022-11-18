<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Validators;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Tour;
use App\Models\Tournament;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    use LimitUserPermissions;

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
        CRUD::setEntityNameStrings('event', 'events');
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

        CRUD::column('tournament')->label('Series');

        CRUD::column('schedule.date_start')->type('datetime')->format('MMM D, YYYY hh:mm a')->label('Start');
        CRUD::column('schedule.date_end')->type('datetime')->format('MMM D, YYYY hh:mm a')->label('End');
        CRUD::column('tournament.minimized_timezone')->label('Timezone');

        // CRUD::column('event_date_start')->type('date')->format(config('app.date_format'))->label('Start date');
        // CRUD::column('event_date_end')->type('date')->format(config('app.date_format'))->label('End date');
        $this->crud->addButtonFromModelFunction('line', 'openLevel', 'openLevel', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_payout', 'openPayout', 'beginning');
        // $this->crud->addButtonFromModelFunction('line', 'open_chip_count', 'openChipCount', 'beginning');
        // TODO: Chips should be part of days
        $this->crud->addButtonFromModelFunction('line', 'days', 'openDay', 'beginning');

    $this->crud->addFilter([
    'name'  => 'tournament_id',
    'type'  => 'select2',
    'label' => 'Series'
    ], function() {
        return Tournament::all()->sortBy('title')->pluck('title', 'id')->toArray();
    }, function($value) { // if the filter is active
        $this->crud->addClause('where', 'tournament_id', $value);
    });

    $this->crud->addFilter([
    'name'  => 'timezone_filter',
    'type'  => 'select2',
    'label' => 'Timezone'
    ], function() {
        return \Timezone::getTimezones();
    }, function($value) { // if the filter is active
        $this->crud->query = $this->crud->query->whereHas('tournament', function ($query) use ($value) {
                $query->where('timezone', $value);
        });
    });

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
        CRUD::setValidation(EventRequest::class);

        $this->crud->addField([
            'name' => 'tournament_id',
            'label' => 'Series',
            'type' => 'relationship',
            'entity' => 'tournament',
            'attribute' => 'parent',
            'allows_null' => false,
            'options' => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),

            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);

        CRUD::field('title');

        $this->crud->addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder' => config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);

        CRUD::field('description');

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


        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->addDays(1)->toDateTimeString();
        $pokerTours = Tour::all();


    $this->crud->addField([
        'name' => 'event_game_table',
        'label' => 'Games',
        'type' => 'relationship',
        'allows_null' => false,
        // 'options' => (function ($query) {
        //     return $query->where('author_id', '=', 0)->orWhere('author_id', '=', null)->get();
        // }),
    ]);

    $this->crud->addField([
        'name' => 'buyin',
        'type' => 'number',
        'hint' =>  'note: All numbers will follow the currency from the series'
    ]);

    $this->crud->addField([
        'name' => 'fee',
        'type' => 'number',
        'hint' => 'note: All numbers will follow the currency from the series',
    ]);


        $this->crud->addField([
            'name' => 'image',
            'type' => 'image',
            'aspect_ratio' => 3 / 2,
            'crop' => true,
        ]);

        // $this->crud->addField([
        //     'name' => 'custom-ajax-button',
        //     'type' => 'view',
        //     'view' => 'partials/custom-ajax-button',
        // ]);
    }

    public function showDetailsRow($id)
    {
        // $this->data['entry'] = $this->crud->getEntry($id);
        // $this->data['crud'] = $this->crud;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::event_details', ['event' => Event::find($id)]);
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
        // Widget::add()->to('after_content')->type('view')->view('vendor.backpack.helper.excel.uploader')->eventId($id); // widgets to show the ordering card
    }

    public function store(Request $request)
    {
        $this->crud->hasAccessOrFail('create');



        // if ($schedules === null) {
        //     Validator::make($schedules ?? [],
        //         [
        //             'schedule' => 'required',
        //         ], [
        //             'schedule' => 'please check the schedule',
        //         ])->validate();
        // }

        $request = $this->crud->validateRequest();

        // $date  = \Carbon\Carbon::parse($request->get('date_start'), session()->get('timezone') ?? 'UTC') ;
        // $request['date_start'] = $date->setTimezone('UTC');

        // $date2  = \Carbon\Carbon::parse($request->get('date_end'), session()->get('timezone') ?? 'UTC') ;
        // $request['date_end'] = $date2->setTimezone('UTC');

        $this->crud->registerFieldEvents();

        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

        $this->data['entry'] = $this->crud->entry = $item;

        session()->flash('new_reports', $item->id);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update()
    {

        // if ($schedules === null) {
        //     Validator::make($schedules ?? [],
        //         [
        //             'schedule' => 'required',
        //         ], [
        //             'schedule' => 'please check the schedule',
        //         ])->validate();
        // }

        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // $tournament = Tournament::find($request->tournament_id);
        // $timezone_offset_minutes = $request->user_timezone;  // $_GET['timezone_offset_minutes']

        // $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
        // // $convertedDateEnd = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::parse($request->date_end), $timezone_name);

        // $request->date_start = Carbon::parse($request->date_start, $timezone_name)->setTimezone('UTC');
        // $request->date_end = Carbon::parse($request->date_end, $timezone_name)->setTimezone('UTC');

        // dd($request);

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        // update the row in the db
        $item = $this->crud->update(
            $request->get($this->crud->model->getKeyName()),
            $this->crud->getStrippedSaveRequest($request)
        );
        $this->data['entry'] = $this->crud->entry = $item;

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function destroy($id)
    {
        if ($this->crud->getCurrentEntry()->event_reports->count()) {
            return \Alert::error('This event has live reporting inside')->flash();
        }
        $this->crud->hasAccessOrFail('delete');

        $id = $this->crud->getCurrentEntryId() ?? $id;

        return $this->crud->delete($id);
    }
}
