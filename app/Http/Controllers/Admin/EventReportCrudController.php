<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewReport;
use DateTime;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Http\Request;
use App\Models\ArticleAuthor;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Library\Widget;
use App\Http\Requests\EventReportRequest;
use Illuminate\Support\Facades\Validator;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\EventReport::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/report');


        $this->crud->denyAccess('show');

        if (request()->get('event') || session()->get('event_id')) {
            if (request()->get('event') !== null) {
                session()->put('event_id', request()->get('event'));
            }

            $getEvent = Event::where('id', session()->get('event_id'))->first();
            CRUD::setEntityNameStrings('reports', $getEvent?->title);

        // $this->crud->addFilter($options, $values, $filter_logic);
        } else {
            $this->crud->denyAccess('create');
        }
        $this->crud->orderBy('date_added', 'DESC');
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

        Widget::add()->type('script')->content('assets/js/admin/forms/image_condition.js');
        $this->setupListOperation();
    }

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

    protected function setupListOperation()
    {
        Widget::add()->to('after_content')->type('view')->view('vendor.backpack.helper.live_report'); // widgets to show the ordering card
        $this->crud->addClause('where', 'event_id', session()->get('event_id'));

        $this->crud->addButtonFromModelFunction('line', 'open_google', 'shareToSocialMedia', 'beginning');
        if (session()->get('new_reports')) {
            $liveReportId = EventReport::find(session()->get('new_reports'))->first()->id;
            Widget::add()->to('before_content')->type('view')->view('vendor.backpack.custom.share')->liveReportId($liveReportId); // widgets to show the ordering card
        }
        $this->crud->addColumn([
            'name' => 'title',
            'type' => 'text',
            'wrapper' => [
                'href' => function ($entry, $column, $crud) {
                    return '/live-report/report/'.$crud->id;
                },
            ],

        ]);

        CRUD::column('date_added');
    }

    protected function setupCreateOperation()
    {


        Widget::add()->type('script')->content('assets/js/admin/forms/image_condition.js');
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
                'name' => 'event_id',
                'type' => 'hidden',
                'value' => session()->get('event_id'),
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);

        // $lastLevelId = DB::table('event_reports')
        // ->join('levels', function ($join) {
        //     $join->on('levels.id', '=', 'event_reports.level_id');
        // })->where('event_id', request()->session()->get('event_id'))->orderByDesc('name')
        // ->get(['level_id'])->first()->level_id ?? 1;

        CRUD::field('title');

        $this->crud->addField([
            'name' => 'slug',
            'attributes' => [
                'placeholder'=> config('app.slug_placeholder'),
            ],
            'type' => 'text',
        ]);

        $author = ArticleAuthor::where('user_id', backpack_user()->id)->first();

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
            ]]);

            if ($this->crud->getCurrentOperation() == 'create') { 
            $this->crud->addField(
            [
                'name' => 'article_author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'value' => $author?->id ,
                'label' => 'Author',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);
             } else {
            $this->crud->addField(
            [
                'name' => 'article_author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'label' => 'Author',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);

             }

        $this->crud->addFields([

            [   // DateTime
                'name' => 'date_added',
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
            [
                'label' => 'Levels',
                'type' => 'relationship',
                'name' => 'level', // the method that defines the relationship in your Model
                'entity' => 'level', // the method that defines the relationship in your Model
                'attribute' => 'level', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'level'],
                'ajax' => true,
                   'minimum_input_length' => 0,
                'allows_null' => true,
                'value' => $this->crud->getCurrentOperation() === 'create' ? EventReport::lastLevel()->id ?? 0  : $this->crud->getCurrentEntry()->level->id,
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
            [
                'label' => 'Schedule',
                'name' => 'labelSchedule',
                'type' => 'hidden',
                'value' => $event?->currentDateSchedule(),
                'wrapper' => [
                    'class' => 'form-group col-md-10',
                ],

            ],
            [
                'label' => 'Day',
                'name' => 'day',
                'type' => 'hidden',
                'value' => $event?->currentDay() ?? '',
                'attributes' => [
                    'readonly' => 'readonly',
                  ],
                'wrapper' => [
                    'class' => 'form-group col-md-2',
                ],
            ],

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
                ],
            ],
            [
                'name' => 'image_caption',
                'type' => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-6 image_caption d-none',
                ],
            ],
            [
                'label' => 'Theme',
                'name' => 'image_theme',
                'type' => 'select2_from_array',
                'options' => [
                    'brokenMirror' => 'broken mirror',
                    'bulletHole' => 'bullet hole',
                    'flames' => 'flames',
                    'happyBirthday' => 'happy birthay',
                    'iceCubes' => 'ice cubes',
                    'pocketAces' => 'pocket aces',
                    'sunRays' => 'sun rays',
                    'waterleaves' => 'water leaves',
                    'waterWaves' => 'water waves',
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-6 image_theme d-none',
                ],
            ],
            [
                'label' => 'Tags',
                'type' => 'relationship',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'tag'],
                'ajax' => true,
                   'minimum_input_length' => 0,
                'allows_null' => true,
                // 'value' => $this->crud->getCurrentOperation() === 'update' ? $this->crud->getCurrentEntry()->level->id : $lastLevelId,
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ],
            [
                'name' => 'players',
                //chip stack
                'label' => 'Chip Counts',
                'type' => 'repeatable',
                

            'attributes' => [
            'id' => 'repeat'
            ],
                'new_item_label' => 'add stack',
                'tab' => 'Chip Stack',
                'subfields' => [
                    [
                        'label' => 'Player',
                        'type' => 'relationship',
                        'name' => 'player_id', // the method that defines the relationship in your Model
                        'entity' => 'player', // the method that defines the relationship in your Model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                        'inline_create' => ['entity' => 'player'],
                        'minimum_input_length' => 0,
                        'allows_null' => true,
                        'ajax' => true,

                    ],
                    [   //image
                        'label' => 'Chips',
                        'name' => 'current_chips',
                        'type' => 'number',
                    ],
                    [   //image
                        'label' => 'Rank',
                        'name' => 'rank',
                        'type' => 'hidden',
                        'value' => '',
                    ],
                    [   //image
                        'label' => 'Payout',
                        'name' => 'payout',
                        'value' => '',
                        'type' => 'text',
                    ],
                ],
                'init_rows' => 0,
            ],
        ]);


        

        Widget::add()->type('script')->content('assets/js/admin/forms/repeatable_chips.js');

        // if ($this->crud->getCurrentOperation() === 'update') {
        //     $liveReport = LiveReport::find($this->crud->getCurrentEntryId());
        //     $players = collect($liveReport->liveReportPlayers);
        // }
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
    }

    public function fetchLevel()
    {
        return $this->fetch(

        [
          'model' =>  \App\Models\Level::class,
          'paginate' => 10,
          'searchOperator' => 'LIKE',
          'query' => function ($model) {
            return $model->where('event_id', session()->get('event_id'));
          }
        ]
        );
    }

    public function fetchPlayer()
    {
        return $this->fetch(\App\Models\Player::class);
    }

    public function store(Request $request)
    {
        $this->crud->hasAccessOrFail('create');

        if (request()->get('day') == 0 ) {
            \Alert::add('error', 'This event schedule hasn\'t has not started yet,' )->flash();
            // return back(); 
        }

        $players = request()->get('players');

        $lastPlayerId = 0;
        if ($players !== null) {
            foreach ($players as $user) {

                if ($user['player_id'] == $lastPlayerId ) {
                    Validator::make([],
                    ['player_id' => 'required',
                    ],
                    [
                    'player_id' => 'There is a duplicate player in Chip Stacks',
                    ])->validate();
                }

                $lastPlayerId = $user['player_id'];

                Validator::make($user,
                    ['player_id' => 'required',
                        'current_chips' => 'required',
                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',
                    ])->validate();
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

        NewReport::dispatch();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update()
    {
        $players = request()->get('players');
        if ($players !== null) {
            $lastPlayerId = 0;
            foreach ($players as $user) {


                if ($user['player_id'] == $lastPlayerId ) {
                    Validator::make([],
                    ['player_id' => 'required',
                    ],
                    [
                    'player_id' => 'There is a duplicate player in Chip Stacks',
                    ])->validate();
                }

                $lastPlayerId = $user['player_id'];

                Validator::make($user,
                    ['player_id' => 'required',
                        'current_chips' => 'required',

                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',

                    ])->validate();
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


  