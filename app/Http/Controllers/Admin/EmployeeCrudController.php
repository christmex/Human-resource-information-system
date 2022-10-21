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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
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

    public function store(){
        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        $response = $this->traitStore();
        
        $item = $this->crud->getStrippedSaveRequest($request);
        // $item['is_active'] = $item['is_main_role'] = 1;

        $saveEmployeeRole = \App\Models\EmployeeRole::create([
            'employee_id' => $this->data['entry']->id,
            'role_id' => $item['role_id'],
            'department_id' => $item['department_id'],
            'school_level_id' => $item['school_level_id'],
            'employment_status_id' => $item['employment_status_id'],
            'is_active' => 1,
            'is_main_role' => 1,
            'start' => $item['start'],
            'end' => $item['end'],
        ]);

        return $response;
    }

    public function update(){
        $response = $this->traitUpdate();

        // $request = $this->crud->validateRequest();
        
        
       
        // dd($item);

        // do something after save
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
        CRUD::addColumn([
            'name'  => 'sex',
            'label' => 'Sex',
            'type'  => 'boolean',
            'options' => [0 => 'P', 1 => 'L'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'P') {
                        return 'badge badge-danger';
                    }
        
                    return 'badge badge-info';
                },
            ]
        ]);
        CRUD::addColumn([
            "name" => "religion_id",
            "key" => "religion_id",
            "label" => "Religion",
            "entity" => "Religion", //relation in model
            "model" => "App\Models\Religion",
            "type" => "select",
            "attribute" => "religion_name"
        ]);
        CRUD::column('highest_certificate');
        CRUD::column('read_employee_rules');
        CRUD::column('start_working');
        CRUD::column('end_contract');
        // Pake ini dari pada yg di bawahnya | last working , selesai ngerjain relation di employee ke employee roles -> role
        // Saat insert pegawai baru, buat employment status automatis 3 bulan percobaan
        // Highest certifikat ganti jdi pendidikan terakhir saja, buat table master pendidikan
        // Nnti karyawan cek, apakah sudah ttd buku pedoman tata tertib or belum, trus buat sk tidak tetap dan pkwt, jika sudah tetap uatkan sk saja
        // Saat menambahkan karyawan baru set berakhir kontrak 3 bulan setelah di daftarkan
        // Saat menambahkan employee baru start working 
        CRUD::addColumn([
            "label" => "Role",
            "entity" => "AllRoles.role", //relation in model
            "model" => "App\Models\EmployeeRole",
            "type" => "select",
            "attribute" => 'name',
            // 'searchLogic' => 'text'
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('AllRoles.role', function ($q) use ($column, $searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            }
        ]);
        CRUD::addColumn([
            "label" => "Register at Goverment Service",
            "entity" => "EmployeeRegisterAtGovService.ServiceCredential", //relation in model
            "model" => "App\Models\EmployeeRegisterAtGovService",
            "type" => "select",
            "attribute" => 'service_name',
            // 'searchLogic' => 'text'
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('EmployeeRegisterAtGovService.ServiceCredential', function ($q) use ($column, $searchTerm) {
                    $q->where('service_name', 'like', '%'.$searchTerm.'%');
                });
            },
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    
                    $obj = $entry->EmployeeRegisterAtGovService;
                    foreach ($obj as $value) {
                        // return $value->ServiceCredential->css_class;
                        return $value->service_credential_id;
                    }
                    // if ($column['text'] == 'P') {
                    //     return 'badge badge-danger';
                    // }
        
                    // return 'badge badge-info';
                }
            ]
        ]);

        CRUD::column('description');
        $this->crud->addButtonFromModelFunction('line', 'register_employee_at_gov_service', 'ButtonForRegisterEmployeeToGovService', 'beginning');
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

        CRUD::field('fullname')->tab('Employee Data');
        CRUD::field('id_card')->tab('Employee Data');
        CRUD::field('place_of_birth')->tab('Employee Data');
        CRUD::field('date_of_birth')->tab('Employee Data');
        $this->crud->addField([
            'type' => 'radio',
            'name' => 'sex', // the relationship name in your Migration
            'options' => [
                0 => "Perempuan",
                1 => "Laki-Laki"
            ],
            'tab'             => 'Employee Data'
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'religion_id', // the relationship name in your Migration
            'entity' => 'Religion', // the relationship name in your Model
            'attribute' => 'religion_name', // attribute that is shown to admin
            'tab'             => 'Employee Data'
        ]);
        CRUD::field('highest_certificate')->tab('Employee Data');
        CRUD::field('start_working')->tab('Employee Data');
        CRUD::field('end_contract')->tab('Employee Data');
        CRUD::field('description')->tab('Employee Data');
        CRUD::field('read_employee_rules')->tab('Employee Data');
        $this->crud->addField([
            'name'            => 'role_id',
            'label'           => "Role",
            'type' => 'select',
            'entity' => 'Role', // the relationship name in your Model
            'attribute' => 'name', // attribute that is shown to admin
            'allows_null'     => true,
            // 'allows_multiple' => true,
            'tab'             => 'Main Role'
        ]);
        $this->crud->addField([
            "name" => "employment_status_id",
            "key" => "employment_status_id",
            "label" => "Employee Status",
            "entity" => "EmploymentStatus", //relation in model
            "model" => "App\Models\EmploymentStatus",
            "type" => "select",
            'allows_null'     => true,
            "attribute" => "employment_status",
            'tab'             => 'Main Role'
        ]);
        $this->crud->addField([
            "name" => "department_id",
            "key" => "department_id",
            "label" => "Department Name",
            "entity" => "Department", //relation in model
            "model" => "App\Models\Department",
            "type" => "select",
            "attribute" => "department_name",
            'tab'             => 'Main Role'
        ]);
        $this->crud->addField([
            "name" => "school_level_id",
            "key" => "school_level_id",
            "label" => "School Level",
            "entity" => "SchoolLevel", //relation in model
            "model" => "App\Models\SchoolLevel",
            "type" => "select",
            "attribute" => "school_level",
            'tab'             => 'Main Role'
        ]);
        CRUD::field('start')->tab('Main Role');
        CRUD::field('end')->tab('Main Role');
        // Set status active and main role true or active
        // $this->crud->addField([
        //     'name'  => 'is_active',
        //     'label' => 'Status Active',
        //     'type'  => 'boolean',
        //     'options' => [0 => 'Inactive', 1 => 'Active'],
        //     'allows_null'     => false,
        //     'tab'             => 'Main Role'
        // ]);
        // $this->crud->addField([
        //     'name'  => 'is_main_role',
        //     'label' => 'Main Role',
        //     'type'  => 'boolean',
        //     'options' => [0 => 'No', 1 => 'Yes'],
        //     'allows_null'     => false,
        //     'tab'             => 'Main Role'
        // ]);
        
        $this->crud->addField([
            'type' => 'select',
            'name' => 'user_id', // the relationship name in your Migration
            'entity' => 'User', // the relationship name in your Model
            'attribute' => 'email', // attribute that is shown to admin
            'allows_null' => true,
            'default' => NULL,
            'tab'             => 'Login Data'
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
        $this->crud->removeField('role_id');
        $this->crud->removeField('employment_status_id');
        $this->crud->removeField('school_level_id');
        $this->crud->removeField('department_id');
        $this->crud->removeField('start');
        $this->crud->removeField('end');
    }
}
