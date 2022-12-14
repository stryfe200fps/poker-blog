<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventReportRequest;
use App\Models\Author;
use App\Models\Day;
use App\Models\Event;
use App\Models\EventReport;
use App\Services\BackpackUIService;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class LiveReportCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventReportCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use LimitUserPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\EventReport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/report');
        CRUD::setEntityNameStrings('report', 'report');

        $this->crud->denyAccess('show');

        if (request()->get('event') || session()->get('event_id')) {
            if (request()->get('event') !== null && request()->get('day') !== null) {
                session()->put('event_id', request()->get('event'));
                session()->put('event_day', request()->get('day'));
            }

            $getEvent = Event::where('id', session()->get('event_id'))->first();
            $getDay = Day::where('id', session()->get('event_day'))->first();
            CRUD::setEntityNameStrings(
                'report',
                'Report'
            );
            // CRUD::setHeading('Reports: <a href="/admin/day?event='.$getEvent->id.'">'.  $getEvent?->title.'</a> -
            // Day '.$getDay?->name);
            customHeading('day?event=' . $getEvent->id, 'Day', $getDay?->name);
            CRUD::setTitle($getEvent?->title);
        } else {
            $this->crud->denyAccess('create');
        }

        $this->crud->with(['event']);
        $this->crud->orderBy('published_date', 'DESC');
        $this->denyAccessIfNoPermission();
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
        $this->crud->disableResponsiveTable();
        Widget::add()->to('after_content')->type('view')->view('vendor.backpack.helper.live_report'); // widgets to show the ordering card
        $this->crud->addClause('where', 'day_id', session()->get('event_day'));

        $this->crud->addButtonFromModelFunction('line', 'open_fb', 'shareFacebook', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_twitter', 'shareTwitter', 'beginning');

        if (session()->get('new_reports')) {
            $liveReportId = EventReport::find(session()->get('new_reports'))->first()->id;
            Widget::add()->to('before_content')->type('view')->view('vendor.backpack.custom.share')->liveReportId($liveReportId); // widgets to show the ordering card
        }
        $this->crud->addColumn([
            'name' => 'title',
            'type' => 'text',
            'wrapper' => [
                'href' => function ($entry, $column, $crud) {
                    return '/tours/rep/rep/asd/update-' . $crud->id;
                },
            ],
            'limit' => 50

        ]);

        CRUD::column('realtime_date')->type('datetime')->format('MMM D, YYYY hh:mm a')->label('Published Date');
    }

    protected function setupCreateOperation()
    {

        $ui = new BackpackUIService();

        if (!session()->get('event_id')) {
            $this->crud->denyAccess('create');
        }


        $event = Event::where('id', session()->get('event_id'))->first();

        CRUD::setValidation(EventReportRequest::class);
        $this->crud->addField([

            'name' => 'user_id',
            'type' => 'hidden',
            'value' => auth()->user()->id,
            'label' => 'author',
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],

        ]);

        $this->crud->addField(
            [
                'name' => 'fake_event',
                'type' => 'hidden',
                'fake' => true,
                'value' => session()->get('event_id'),
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]
        );

        $ui->title();

        $author = Author::where('user_id', backpack_user()->id)->first();

        $ui->content();

        if ($this->crud->getCurrentOperation() == 'create') {
            $this->crud->addField(
                [
                    'name' => 'author_id',
                    'type' => 'select2',
                    'attribute' => 'fullname',
                    'value' => $author?->id,
                    'label' => 'Author',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ]
            );
        } else {
            $this->crud->addField(
                [
                    'name' => 'author_id',
                    'type' => 'select2',
                    'attribute' => 'fullname',
                    'label' => 'Author',
                    'wrapper' => [
                        'class' => 'form-group col-md-12',
                    ],
                ]
            );
        }

        $this->crud->addFields([

            [   // DateTime
                'name' => 'published_date',
                'label' => 'Date',
                'type' => 'datetime_picker',
                'default' => 'now',
                'datetime_picker_options' => [
                    'format' => 'MMM D, YYYY hh:mm a',
                    'tooltips' => [ //use this to translate the tooltips in the field
                        'today' => 'Hoje',
                        'selectDate' => 'Selecione a data',
                        // available tooltips: today, clear, close, selectMonth, prevMonth, nextMonth, selectYear, prevYear, nextYear, selectDecade, prevDecade, nextDecade, prevCentury, nextCentury, pickHour, incrementHour, decrementHour, pickMinute, incrementMinute, decrementMinute, pickSecond, incrementSecond, decrementSecond, togglePeriod, selectTime, selectDate
                    ],
                ],
                'allows_null' => false,
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],

            ],
        ]);
        $this->crud->addField([
            'name' => 'test',
            'type' => 'custom_html',
            'value' => 'date and time is based on ' . session()->get('timezone') . ' timezone' ?? '',
            'wrapper' => [
                'class' => 'my-auto form-group col-md-6',
                'style' => ' color:black; font-style:italic; '
            ],

        ]);

        CRUD::field('day_id')->type('hidden')->value(session()->get('event_day'));

        $this->crud->addFields([
            [
                'label' => 'Levels',
                'type' => 'relationship',
                'name' => 'level_id', // the method that defines the relationship in your Model
                'entity' => 'level', // the method that defines the relationship in your Model
                'attribute' => 'level_value', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'level'],
                'ajax' => true,
                'minimum_input_length' => 0,
                'allows_null' => false,
                'value' => $this->crud->getCurrentOperation() === 'create' ? EventReport::lastLevel()?->id ?? 0 : $this->crud->getCurrentEntry()->level?->id,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ],
            [
                'name' => 'fake_tags',
                'type' => 'view',
                'view' => 'tag_custom_selector',
            ],
            [
                'name' => 'eventChipPlayers',
                'label' => 'Players\' stack',
                'type' => 'repeatable',
                'attributes' => [
                    'id' => 'repeat',
                ],
                'new_item_label' => 'add stack',
                'tab' => 'Chip Stack',
                'subfields' => [
                    [
                        'name' => 'id',
                        'type' => 'hidden',
                    ],
                    [
                        'label' => 'Player',
                        'type' => 'relationship',
                        'name' => 'player_id', // the method that defines the relationship in your Model
                        'entity' => 'player', // the method that defines the relationship in your Model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                        'inline_create' => ['entity' => 'player'],
                        'minimum_input_length' => 0,
                        'allows_null' => false,
                        'ajax' => true,

                    ],
                    [   //image
                        'label' => 'Chips',
                        'name' => 'current_chips',
                        'type' => 'number',
                    ],

                    [   //image
                        'name' => 'divider',
                        'type' => 'custom_html',
                        'value' => '<hr>',
                    ],

                    [   //image
                        'name' => 'divider',
                        'type' => 'custom_html',
                        'value' => '<b>Payout</b>',
                    ],
                    [   //image
                        'label' => 'Rank',
                        'name' => 'rank',
                        'type' => 'hidden',
                        'value' => '',
                    ],
                    [
                        'label' => 'Position',
                        'name' => 'position',
                        'value' => '',
                        'type' => 'number',
                    ],
                    [   //image
                        'label' => 'Payout',
                        'name' => 'payout',
                        'value' => '',
                        'type' => 'number',
                    ],
                ],
                'init_rows' => 0,
            ],
        ]);

        $this->crud->addField([
            'name' => 'type',
            'type' => 'select2_from_array',
            'options' => [
                'report' => 'report',
                'stack' => 'stack',
                'level' => 'level',
                'content' => 'content',
            ],
            'allows_null' => false,
            'default' => 'report',
        ]);


        $this->crud->addFields(
            [
                [
                    'label' => 'Media',
                    'name' => 'divider',
                    'type' => 'custom_html',
                    'value' => '<b>Media</b>',
                ],
                [
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'crop' => true, // set to true to allow cropping, false to disable
                    'aspect_ratio' => 3 / 2, // omit or set to 0 to allow any aspect ratio
                    'wrapper' => [
                        'class' => 'form-group col-md-12 image',
                        'id' => 'image',
                    ],
                ],
                [
                    'name' => 'image_caption',
                    'type' => 'text',
                    'wrapper' => [
                        'class' => 'form-group col-md-6 image_caption  ',
                    ],
                ],
                [
                    'label' => 'Theme',
                    'name' => 'image_theme',
                    'type' => 'relationship',
                    'attributes' => [
                        'id' => 'image-theme',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-6 image_theme ',
                    ],
                ],

            ]
        );

        if ($this->crud->getCurrentOperation() === 'create') {
            Widget::add()->type('script')->content('assets/js/admin/create-admin-image-theme-attach.js');
        }
    }

    public function fetchTags()
    {
        return $this->fetch(\App\Models\Tag::class);
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
        Widget::add()->type('script')->content('assets/js/admin/forms/repeatable_chips.js');
        // Widget::add()->type('script')->content('assets/js/admin/update-admin-image-theme-attach.js');
    }

    public function fetchLevel()
    {
        return $this->fetch(
            [
                'model' => \App\Models\Level::class,
                'paginate' => 10,
                'searchOperator' => 'LIKE',
                'query' => function ($model) {
                    return $model->where('event_id', session()->get('event_id'))->orderByDesc('level');
                },
            ]
        );
    }

    public function fetchPlayer()
    {
        return $this->fetch(
            [
                'model' => \App\Models\Player::class,
                'paginate' => 10,
                'searchOperator' => 'LIKE',
                'query' => function ($model) {
                    return $model->where('status', '!=', 'disabled')->orderBy('name');
                },
            ]
        );
        // return $this->fetch(\App\Models\Player::class);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->crud->hasAccessOrFail('create');

        // if (request()->get('day') == 0) {
        //     \Alert::add('error', 'This event schedule hasn\'t has not started yet,')->flash();
        // }

        $players = request()->get('eventChipPlayers');

        $lastPlayerId = 0;
        if ($players !== null) {
            foreach ($players as $user) {
                Validator::make(
                    $user,
                    [
                        'player_id' => 'required',
                        'current_chips' => 'required',
                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',
                    ]
                )->validate();

                if ($user['player_id'] == $lastPlayerId) {
                    Validator::make(
                        [],
                        [
                            'player_id' => 'required',
                            'current_chips' => 'required',
                        ],
                        [
                            'player_id' => 'There is a duplicate player in Chip Stacks',
                            'current_chips' => 'Chip field is required',
                        ]
                    )->validate();
                }

                $lastPlayerId = $user['player_id'];
            }
        } else {
            $request['players'] = '';
        }

        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();

        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

        $this->data['entry'] = $this->crud->entry = $item;

        session()->flash('new_reports', $item->id);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update()
    {
        $players = request()->get('players');
        if ($players !== null) {
            $lastPlayerId = 0;

            foreach ($players as $user) {
                Validator::make(
                    $user,
                    [
                        'player_id' => 'required',
                        'current_chips' => 'required',

                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',

                    ]
                )->validate();

                if ($user['player_id'] == $lastPlayerId) {
                    Validator::make(
                        $user,
                        [
                            'player_id' => 'required',
                            'current_chips' => 'required',
                        ],
                        [
                            'player_id' => 'There is a duplicate player in Chip Stacks',

                            'current_chips' => 'Chip field is required',
                        ]
                    )->validate();
                }

                $lastPlayerId = $user['player_id'];
            }
        }

        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

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
}
