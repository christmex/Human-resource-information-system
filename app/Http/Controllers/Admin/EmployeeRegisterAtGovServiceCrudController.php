<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\ServiceCredential;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\EmployeeRegisterAtGovServiceRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeRegisterAtGovServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeRegisterAtGovServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
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
        CRUD::setModel(\App\Models\EmployeeRegisterAtGovService::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee-register-at-gov-service');
        CRUD::setEntityNameStrings('employee register at gov service', 'employee register at gov services');
    }

    public function store(){
        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        
        // Get all of the request in array
        $item = $this->crud->getStrippedSaveRequest($request);

        // Get employee highest status data
        $Employee = Employee::find($item['employee_id'])->GetMinEmployeeEmploymentStatus(); 

        // Get all Goverment service with employee status
        $ServiceCredential = ServiceCredential::find($item['service_credential_id'])->GovermentService->EmploymentStatus->order;

        // Check if the user status more highest than credential status 
        if($ServiceCredential < $Employee){
            // return \Alert::success(trans('backpack::crud.insert_success'))->flash();
            \Alert::error('Employee status cant perform this action')->flash();
            return back()->withInput();
        }

        $response = $this->traitStore();
        return $response;

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
            "label" => "Employee Name",
            "entity" => "Employee",
            "model" => "App\Models\Employee",
            "type" => "select",
            "attribute" => "fullname"
        ]);
        CRUD::addColumn([
            "label" => "Service Name",
            "entity" => "ServiceCredential",
            "model" => "App\Models\ServiceCredential",
            "type" => "select",
            "attribute" => "service_name"
        ]);
        CRUD::column('register_at');

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
        CRUD::setValidation(EmployeeRegisterAtGovServiceRequest::class);

        $this->crud->addField([
            'type' => 'select',
            'name' => 'employee_id', // the relationship name in your Migration
            'entity' => 'employee', // the relationship name in your Model
            'attribute' => 'fullname', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        // Ini harusnya melakukan pengecekan dulu, jika employee_id dibagian employee rolenya sudah ada yg yg bisa di tambah kesini maka tampilkan jika tidak hide
        $this->crud->addField([
            'type' => 'select',
            'name' => 'service_credential_id', // the relationship name in your Migration
            'entity' => 'ServiceCredential', // the relationship name in your Model
            'attribute' => 'service_name', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        // CRUD::field('goverment_service_id');
        CRUD::field('register_at');

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
