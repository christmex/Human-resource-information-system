{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<!-- Setting -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i> Settings</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('department') }}"><i class="nav-icon la la-building"></i> Departments</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('school-level') }}"><i class="nav-icon la la-school"></i> School levels</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employment-status') }}"><i class="nav-icon la la-certificate"></i> Employment statuses</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('religion') }}"><i class="nav-icon la la-pray"></i> Religions</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('service-credential') }}"><i class="nav-icon la la-user-shield"></i> Service credentials</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('goverment-service') }}"><i class="nav-icon la la-monument"></i> Goverment services</a></li>
    </ul>
</li>

<!-- Employees -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Employees</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee') }}"><i class="nav-icon la la-list"></i> All Employee</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-role') }}"><i class="nav-icon la la-briefcase"></i> Employee roles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-register-at-gov-service') }}"><i class="nav-icon la la-monument"></i> Employee register at gov services</a></li>
    </ul>
</li>

<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('job-position') }}"><i class="nav-icon la la-question"></i> Job positions</a></li> -->


<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('department') }}"><i class="nav-icon la la-question"></i> Departments</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee') }}"><i class="nav-icon la la-question"></i> Employees</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-register-at-gov-service') }}"><i class="nav-icon la la-question"></i> Employee register at gov services</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-role') }}"><i class="nav-icon la la-question"></i> Employee roles</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('employment-status') }}"><i class="nav-icon la la-question"></i> Employment statuses</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('goverment-service') }}"><i class="nav-icon la la-question"></i> Goverment services</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('school-level') }}"><i class="nav-icon la la-question"></i> School levels</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('service-credential') }}"><i class="nav-icon la la-question"></i> Service credentials</a></li> -->
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('religion') }}"><i class="nav-icon la la-question"></i> Religions</a></li> -->