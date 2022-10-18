<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRoleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class EmployeeRoleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeRoleCrudController extends CrudController
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
        CRUD::setModel(\App\Models\EmployeeRole::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee-role');
        CRUD::setEntityNameStrings('employee role', 'employee roles');
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
            "name" => "employee_id",
            "key" => "employee_id",
            "label" => "Employee Name",
            "entity" => "Employee",
            "model" => "App\Models\Employee",
            "type" => "select",
            "attribute" => "fullname"
        ]);
        CRUD::addColumn([
            "name" => "role_id",
            "key" => "role_id",
            "label" => "Role",
            "entity" => "Role", //relation in model
            "model" => SpatieRole::class,
            "type" => "select",
            "attribute" => "name"
        ]);
        CRUD::addColumn([
            "name" => "department_id",
            "key" => "department_id",
            "label" => "Department Name",
            "entity" => "Department", //relation in model
            "model" => "App\Models\Department",
            "type" => "select",
            "attribute" => "department_name"
        ]);
        CRUD::addColumn([
            "name" => "school_level_id",
            "key" => "school_level_id",
            "label" => "School Level",
            "entity" => "SchoolLevel", //relation in model
            "model" => "App\Models\SchoolLevel",
            "type" => "select",
            "attribute" => "school_level"
        ]);
        CRUD::addColumn([
            "name" => "employment_status_id",
            "key" => "employment_status_id",
            "label" => "Employee Status",
            "entity" => "EmploymentStatus", //relation in model
            "model" => "App\Models\EmploymentStatus",
            "type" => "select",
            "attribute" => "employment_status"
        ]);
        CRUD::addColumn([
            'name'  => 'is_active',
            'label' => 'Status Active',
            'type'  => 'boolean',
            'options' => [0 => 'Inactive', 1 => 'Active']
        ]);
        CRUD::column('start');
        CRUD::column('end');

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
        CRUD::setValidation(EmployeeRoleRequest::class);

        $this->crud->addField([
            'type' => 'select',
            'name' => 'employee_id', // the relationship name in your Migration
            'entity' => 'employee', // the relationship name in your Model
            'attribute' => 'fullname', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'role_id', // the relationship name in your Migration
            'entity' => 'Role', // the relationship name in your Model
            'attribute' => 'name', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'employment_status_id', // the relationship name in your Migration
            'entity' => 'EmploymentStatus', // the relationship name in your Model
            'attribute' => 'employment_status', // attribute that is shown to admin
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'department_id', // the relationship name in your Migration
            'entity' => 'Department', // the relationship name in your Model
            'attribute' => 'department_name', // attribute that is shown to admin
            'allows_null' => true,
            'default' => NULL
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'school_level_id', // the relationship name in your Migration
            'entity' => 'SchoolLevel', // the relationship name in your Model
            'attribute' => 'school_level', // attribute that is shown to admin
            'allows_null' => true,
            'default' => NULL
        ]);
        $this->crud->addField([
            'name' => 'start',
            'label' => 'Start Year'
        ]);
        $this->crud->addField([
            'name' => 'end',
            'label' => 'End Year'
        ]);
        $this->crud->addField([
            'name' => 'is_active',
            'label' => 'Active Status',
            'default' => true
        ]);
        // CRUD::field('start');
        // CRUD::field('end');

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
