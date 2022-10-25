<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Http\Requests\DayRequest;
use App\Models\Day;
use Backpack\CRUD\app\Library\Widget;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DayCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DayCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation { reorder as traitReorder; }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements 
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 1);
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {

        $this->crud->denyAccess('show');
        CRUD::setModel(\App\Models\Day::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/day');
        CRUD::setEntityNameStrings('day', 'days');

        if (request()->get('event') || session()->get('event_id')) {
            if (request()->get('event') !== null) {
                session()->put('event_id', request()->get('event'));
            }

            $getEvent = Event::where('id', session()->get('event_id'))->first();

            // dd($getEvent->getTree());

            $day = Day::where('event_id', $getEvent->id);

            // dd($getEvent->getSchedule());

            // dd($day->get()->map(function ($m) {
            //     return $m->report_count();
            // }));


            CRUD::setEntityNameStrings('day', $getEvent?->title);
        } else {
            $this->crud->denyAccess('create');
        }

        $this->crud->query = $this->crud->query->where('event_id', session()->get('event_id'));


        $this->crud->orderBy('lft');

        // $this->crud->orderBy('date_added', 'DESC');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('date_start')->type('date')
            ->format(config('app.date_format'));

        CRUD::column('date_end')->type('date')
            ->format(config('app.date_format'));
        $this->crud->addButtonFromModelFunction('line', 'openReport', 'openReport', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'openChipCount', 'openChipCount', 'beginning');
    }



    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */

    public function reorder()
    {
        // your custom code here

        // dd($this->crud->getReorderView());
    
        // call the method in the trait
        return $this->traitReorder();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(DayRequest::class);

        CRUD::field('name');

        CRUD::field('event_id')->type('hidden')
            ->value(session()->get('event_id'));

        CRUD::field('date_start')->type('datetime_picker');

        CRUD::field('date_end')->type('datetime_picker');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        Widget::add()->to('after_content')
         ->type('view')
         ->view('vendor.backpack.helper.excel.uploader')
         ->eventId(session()->get('event_id'))
         ->dayId($this->crud->getCurrentEntryId()); 
    }
}
