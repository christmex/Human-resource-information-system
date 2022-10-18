<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('employee', 'employees');
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
            "name" => "user_id",
            "key" => "user_id",
            "label" => "Email",
            "entity" => "User", //relation in model
            "model" => "App\Models\User",
            "type" => "select",
            "attribute" => "email"
        ]);
        CRUD::column('fullname');
        CRUD::column('id_card');
        CRUD::column('place_of_birth');
        CRUD::column('date_of_birth');
        CRUD::column('start_working');
        // CRUD::addColumn([
        //     "name" => "employment_status_id",
        //     "key" => "employment_status_id",
        //     "label" => "Employee Status",
        //     "entity" => "EmploymentStatus", //relation in model
        //     "model" => "App\Models\EmploymentStatus",
        //     "type" => "select",
        //     "attribute" => "employment_status"
        // ]);
        CRUD::column('end_contract');
        // CRUD::addColumn([
        //     "name" => "department_id",
        //     "key" => "department_id",
        //     "label" => "Department Name",
        //     "entity" => "Department", //relation in model
        //     "model" => "App\Models\Department",
        //     "type" => "select",
        //     "attribute" => "department_name"
        // ]);
        // CRUD::addColumn([
        //     "name" => "school_level_id",
        //     "key" => "school_level_id",
        //     "label" => "School Level",
        //     "entity" => "SchoolLevel", //relation in model
        //     "model" => "App\Models\SchoolLevel",
        //     "type" => "select",
        //     "attribute" => "school_level"
        // ]);
        CRUD::column('description');
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
        CRUD::setValidation(EmployeeRequest::class);

        $this->crud->addField([
            'type' => 'select',
            'name' => 'user_id', // the relationship name in your Migration
            'entity' => 'User', // the relationship name in your Model
            'attribute' => 'email', // attribute that is shown to admin
            'allows_null' => true,
            'default' => NULL
        ]);
        CRUD::field('fullname');
        CRUD::field('id_card');
        CRUD::field('place_of_birth');
        CRUD::field('date_of_birth');
        CRUD::field('start_working');
        // $this->crud->addField([
        //     'type' => 'select',
        //     'name' => 'employment_status_id', // the relationship name in your Migration
        //     'entity' => 'EmploymentStatus', // the relationship name in your Model
        //     'attribute' => 'employment_status', // attribute that is shown to admin
        //     'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        // ]);
        CRUD::field('end_contract');
        // $this->crud->addField([
        //     'type' => 'select',
        //     'name' => 'department_id', // the relationship name in your Migration
        //     'entity' => 'Department', // the relationship name in your Model
        //     'attribute' => 'department_name', // attribute that is shown to admin
        //     'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        // ]);
        // $this->crud->addField([
        //     'type' => 'select',
        //     'name' => 'school_level_id', // the relationship name in your Migration
        //     'entity' => 'SchoolLevel', // the relationship name in your Model
        //     'attribute' => 'school_level', // attribute that is shown to admin
        //     'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        // ]);
        CRUD::field('description');

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
