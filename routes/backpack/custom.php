<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('school-level', 'SchoolLevelCrudController');
    Route::crud('employment-status', 'EmploymentStatusCrudController');
    Route::crud('job-position', 'JobPositionCrudController');
    Route::crud('goverment-service', 'GovermentServiceCrudController');
    Route::crud('service-credential', 'ServiceCredentialCrudController');
    Route::crud('employee', 'EmployeeCrudController');
    Route::crud('employee-role', 'EmployeeRoleCrudController');
    Route::crud('employee-register-at-gov-service', 'EmployeeRegisterAtGovServiceCrudController');
    Route::crud('religion', 'ReligionCrudController');
}); // this should be the absolute last line of this file