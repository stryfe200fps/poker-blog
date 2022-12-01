<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Validators;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Tour;
use App\Models\Tournament;
use App\Services\BackpackFilterService;
use App\Services\BackpackUIService;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {
        destroy as traitDestroy;
    }
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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/events');
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
        $this->crud->addButtonFromModelFunction('line', 'openLevel', 'openLevel', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'open_payout', 'openPayout', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'days', 'openDay', 'beginning');
        (new BackpackFilterService())->tournaments($this);
        (new BackpackFilterService())->timezone($this);
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
        $ui = new BackpackUIService();
        CRUD::setValidation(EventRequest::class);


        CRUD::field('is_live')->type('switch')->label('Live');

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
        ]);

        $ui->title();
        $ui->slug();
        $ui->description();
        $ui->content();
        CRUD::field('event_game_table')->label('Games')->type('relationship')->allows_null(false);
        CRUD::field('label_local')->value('<b>Local Rate</b><br><hr>')->type('custom_html');
        CRUD::field('buyin')->type('number')->hint('note: All numbers will follow the currency from the series');
        CRUD::field('fee')->type('number')->hint('note: All numbers will follow the currency from the series');
        CRUD::field('label_usd')->value('<b>USD Rate</b><br><hr>')->type('custom_html');
        CRUD::field('buyin_usd')->label('Buyin')->type('number')->hint('note: All numbers will follow the currency from the series');
        CRUD::field('fee_usd')->label('Fee')->type('number')->hint('note: All numbers will follow the currency from the series');
        $ui->image();
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
    }

    public function destroy($id)
    {
        if ($this->crud->getCurrentEntry()->event_reports->count()) {
            return \Alert::error('This event has live reporting inside')->flash();
        }

        return $this->traitDestroy($id);
    }
}
