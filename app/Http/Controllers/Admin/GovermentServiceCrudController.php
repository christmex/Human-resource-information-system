<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GovermentServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GovermentServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GovermentServiceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\GovermentService::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/goverment-service');
        CRUD::setEntityNameStrings('goverment service', 'goverment services');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            "label" => "Service Name",
            "entity" => "ServiceCredential",
            "model" => "App\Models\ServiceCredential",
            "type" => "select",
            "attribute" => "service_name"
        ]);
        CRUD::addColumn([
            "label" => "Required Employment Status",
            "entity" => "EmploymentStatus",
            "model" => "App\Models\EmploymentStatus",
            "type" => "select",
            "attribute" => "employment_status"
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
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GovermentServiceRequest::class);

        $this->crud->addField([
            'type' => 'select',
            'name' => 'service_credential_id', // the relationship name in your Migration
            'entity' => 'ServiceCredential', // the relationship name in your Model
            'attribute' => 'service_name', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'required_employment_status_id', // the relationship name in your Migration
            'entity' => 'EmploymentStatus', // the relationship name in your Model
            'attribute' => 'employment_status', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);

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
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
