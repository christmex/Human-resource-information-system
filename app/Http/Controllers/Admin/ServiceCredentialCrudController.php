<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceCredentialRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceCredentialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceCredentialCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ServiceCredential::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/service-credential');
        CRUD::setEntityNameStrings('service credential', 'service credentials');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('service_name');
        CRUD::addColumn([
            'name'  => 'service_url',
            'label' => 'Service Url', // Table column heading
            'wrapper'   => [
                // 'element' => 'a', // the element will default to "a" so you can skip it here
                'href' => function ($crud, $column, $entry, $related_key) {
                    return $entry->service_url;
                },
                'target' => '_blank',
            ],
        ]);
        CRUD::column('service_login');
        CRUD::column('service_password');
        CRUD::column('css_class');
        // CRUD::addColumn([
        //     'name' => 'description',
        //     'visibleInTable' => true
        // ]);
        CRUD::addColumn([
            'name' => 'description',
            'type' => 'textarea',
            'limit' => false,
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
        CRUD::setValidation(ServiceCredentialRequest::class);

        CRUD::field('service_name');
        CRUD::addField([   // URL
            'name'  => 'service_url',
            'label' => 'Service Url',
            'type'  => 'url',
            'hint'       => 'Please Put http:// or https:// as a prefix',
            // 'prefix'       => ' a prefix',
        ]);
        CRUD::field('service_login');
        CRUD::field('service_password');
        CRUD::field('css_class');
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
