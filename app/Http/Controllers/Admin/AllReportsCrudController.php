<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventReportRequest;
use App\Models\ArticleAuthor;
use App\Models\EventReport;
use App\Models\EventChip;
use App\Models\Player;
use App\Models\Event;
use App\Models\Tour;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class LiveReportCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AllReportsCrudController extends CrudController
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
        CRUD::setRoute(config('backpack.base.route_prefix').'/all-reports');

        $this->crud->removeAllFilters();
        $this->crud->denyAccess('show');
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

        CRUD::column('poker_event_id');
        CRUD::column('date_added');

        $this->crud->addFilter([
            'type' => 'text',
            'name' => 'title',
            'label' => 'Title',

        ],
            false,
            function ($value) { // if the filter is active
            $this->crud->addClause('where', 'title', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'poker_event',
            'label' => 'Poker Event',

        ],
            function () {
                return Event::all()->pluck('title', 'id')->toArray();
            },
            function ($values) {
                $this->crud->query = $this->crud->query->whereHas('poker_event', function ($query) use ($values) {
                    $query->where('id', $values);
                });
            });
    }

    protected function setupCreateOperation()
    {
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
                'name' => 'poker_event_id',
                'type' => 'relationship',
                'entity' => 'poker_event',
                'attribute' => 'parent',
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ]);

        $lastLevelId = DB::table('live_reports')
             ->join('levels', function ($join) {
                 $join->on('levels.id', '=', 'live_reports.level_id');
             })->where('poker_event_id', request()->session()->get('event_id'))->orderByDesc('name')
             ->get(['level_id'])->first()->level_id ?? 1;

        CRUD::field('title');
        $author = ArticleAuthor::where('user_id', backpack_user()->id)->first();

        $this->crud->addFields([

            [   // CKEditor
                'name' => 'content',
                'label' => 'Content',
                'type' => 'ckeditor',
                'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
                // optional:
                'options' => [
                    'autoGrow_minHeight' => 200,
                    'autoGrow_bottomSpace' => 50,
                    'removePlugins' => 'resize,maximize',
                ],
            ],

            [
                'name' => 'article_author_id',
                'type' => 'select2',
                'attribute' => 'fullname',
                'value' => $author->id ?? 0,
                'label' => 'Author',

                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
            ],

            [   // DateTime
                'name' => 'date_added',
                'label' => 'Date',
                'type' => 'datetime_picker',

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
                'label' => 'Levels',
                'type' => 'relationship',
                'name' => 'level', // the method that defines the relationship in your Model
                'entity' => 'level', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'level'],
                'ajax' => true,

                'value' => $lastLevelId ?? $this->crud->getCurrentEntry()->level->id,
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
            ],

            [
                'label' => 'Day',
                'name' => 'day',
                'type' => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
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
                    'flame' => 'flame',
                    'ice' => 'ice',
                    'poker' => 'poker',
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-6 image_theme d-none',
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
                        'label' => 'Rank',
                        'name' => 'rank',
                        'type' => 'number',
                    ],
                    [
                        'label' => 'Players',
                        'type' => 'relationship',
                        'name' => 'player_id', // the method that defines the relationship in your Model
                        'entity' => 'player', // the method that defines the relationship in your Model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                        'inline_create' => ['entity' => 'player'],
                        'ajax' => true,
                    ],

                    [   //image
                        'label' => 'Chips',
                        'name' => 'current_chips',
                        'type' => 'number',
                    ],

                    [   //image
                        'label' => 'Payout',
                        'name' => 'payout',
                        'type' => 'number',
                    ],
                ],
                'init_rows' => 0,
            ],

        ]);

        Widget::add()->type('script')->content('assets/js/admin/forms/image_condition.js');

        // if ($this->crud->getCurrentOperation() === 'update') {
        //     $liveReport = EventReport::find($this->crud->getCurrentEntryId());
        //     $players = collect($liveReport->liveReportPlayers);
        // }
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
        Widget::add()->type('script')->content('assets/js/admin/forms/image_condition.js');
    }

    public function fetchLevel()
    {
        return $this->fetch(\App\Models\Level::class);
    }

    public function fetchPlayer()
    {
        return $this->fetch(\App\Models\Player::class);
    }

    public function store(Request $request)
    {
        $this->crud->hasAccessOrFail('create');

        $players = request()->get('players');
        if ($players !== null) {
            foreach ($players as $user) {
                Validator::make($user,
                    ['player_id' => 'required',
                        'current_chips' => 'required',
                        'rank' => 'required',
                        'payout' => 'required',
                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',
                        'payout' => 'Payout is required',
                        'rank' => 'Rank field is required',
                    ])->validate();
            }
        } else {
            $request['players'] = '';
        }

        $request = $this->crud->validateRequest();

        // execute the FormRequest authorization and validation, if one is required

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

        $this->data['entry'] = $this->crud->entry = $item;

        // if ($request->get('players')[0]['player_name'] !== null) {
        //     foreach ($request->get('players') as $player) {
        //         $liveReportPlayer = new EventChip();
        //         $player_id = Player::find($player['player_name']);
        //         $liveReportPlayer->name = $player_id->name;
        //         $liveReportPlayer->player_id = $player['player_name'];
        //         $liveReportPlayer->current_chips = $player['chips'];
        //         $liveReportPlayer->chips_before = 0;
        //         $liveReportPlayer->save();
        //         $item->liveReportPlayers()->attach($liveReportPlayer);
        //     }
        // }

        // collect($request->get('gallery'))
    //     ->filter(fn ($image) => $image['gallery'] != null && $image != '')
    //     ->map(fn ($image) => $item->addMediaFromBase64($image['gallery'])
    //     ->usingFileName(uniqid().'.jpg')
    //     ->toMediaCollection('media'));

        // $extracted = collect($request->all())->filter(fn ($item, $val) => str_contains($val, 'category'));
        // $item->categories()->attach($extracted);

        // show a success message

        session()->flash('new_reports', $item->id);

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

    public function update()
    {
        $players = request()->get('players');
        if ($players !== null) {
            foreach ($players as $user) {
                Validator::make($user,
                    ['player_id' => 'required',
                        'current_chips' => 'required',
                        'rank' => 'required',
                        'payout' => 'required',
                    ],
                    [
                        'player_id' => 'Player field is required',
                        'current_chips' => 'Chip field is required',
                        'payout' => 'Payout is required',
                        'rank' => 'Rank field is required',
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

        // $item->liveReportPlayers()->detach();

        // if ($request->get('players')[0]['player_name'] !== null) {
        //     foreach ($request->get('players') as $player) {
        //         $liveReportPlayer = new EventChip();
        //         $player_id = Player::find($player['player_name']);
        //         $liveReportPlayer->name = $player_id->name;
        //         $liveReportPlayer->player_id = $player['player_name'];
        //         $liveReportPlayer->current_chips = $player['chips'];
        //         $liveReportPlayer->chips_before = 0;
        //         $liveReportPlayer->save();
        //         $item->liveReportPlayers()->attach($liveReportPlayer);
        //     }
        // }

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
}
