<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TournamentRequest;
use App\Models\Tour;
use App\Services\BackpackFilterService;
use App\Services\BackpackUIService;
use App\Traits\LimitUserPermissions;
use Backpack\CRUD\app\Exceptions\BackpackProRequiredException;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TournamentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation { destroy as traitDestroy; }

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
        CRUD::setModel(\App\Models\Tournament::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/series');
        CRUD::setEntityNameStrings('series', 'series');
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
        CRUD::column('tour_id');
        CRUD::column('date_start')->type('datetime')->format(config('app.date_format'));
        CRUD::column('date_end')->type('datetime')->format(config('app.date_format'));

        (new BackpackFilterService)->tours($this);
      
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
        $ui = new BackpackUIService();
        CRUD::setValidation(TournamentRequest::class);
        $ui->pulldownField('tour_id');
        $ui->title();
        $ui->slug();
        $ui->description();
        $ui->content();
        $ui->currency();
        $ui->countries();
        $ui->timezone();
        $ui->dateRange('Series Duration');
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
        $this->setupCreateOperation();
    }

    public function destroy($id)
    {
        if ($this->crud->getCurrentEntry()->events->count()) {
            return \Alert::error('This tournament has events inside')->flash();
        }

        return $this->traitDestroy($id);
    }

}
