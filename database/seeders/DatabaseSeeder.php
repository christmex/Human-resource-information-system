<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Jonathan Christian',
            'email' => 'super@admin.com',
            'password' => bcrypt('mantapjiwa00'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Pinta N Rajagukguk',
            'email' => 'koodirnator@yayasan.com',
            'password' => bcrypt('mantapjiwa00'),
        ]);

        $role1 = SpatieRole::create(['name' => 'Koordinator Yayasan']);
        $role2 = SpatieRole::create(['name' => 'Programmer']);

        // Department
        \App\Models\Department::create([
            'department_name' => 'Batam Center'
        ]);

        \App\Models\Department::create([
            'department_name' => 'Batu Aji'
        ]);

        \App\Models\Department::create([
            'department_name' => 'All Department'
        ]);
        // Department

        // School Levels
        \App\Models\SchoolLevel::create([
            'school_level' => 'TK'
        ]);

        \App\Models\SchoolLevel::create([
            'school_level' => 'SD'
        ]);

        \App\Models\SchoolLevel::create([
            'school_level' => 'SMP'
        ]);

        \App\Models\SchoolLevel::create([
            'school_level' => 'SMA'
        ]);

        \App\Models\SchoolLevel::create([
            'school_level' => 'All Levels'
        ]);
        // School Levels

        
        // Employment Status
        \App\Models\EmploymentStatus::create([
            'employment_status' => '3 Bulan Percobaan',
            'order' => 1,
            'description' => 'Pegawai yang baru '
        ]);

        \App\Models\EmploymentStatus::create([
            'employment_status' => 'GTTY/PTTY',
            'order' => 2,
            'description' => 'Pegawai/Guru Tidak Tetap, umumnya status ini diberikan jika pegawai telah selesai melewati masa percobaan selama 3 bulan plus kinerja yang baik'
        ]);

        \App\Models\EmploymentStatus::create([
            'employment_status' => 'GTY/PTY',
            'order' => 3,
            'description' => 'Pegawai/Guru Tetap, umumnya status ini diberikan jika minimal 2 tahun masa kontrak plus kinerja yang baik, jika kinerja kurang bagus maka kemungkinan pegawai akan dilanjutkan dengan pkwt, di kasus lain, ada pegawai yang tidak perlu menunggu 2 tahun untuk menjadi Pegawai/Guru Tetap'
        ]);

        // Employment Status


        // Service Credential
        \App\Models\ServiceCredential::create([
            'service_name' => 'Wajib Lapor Kemnaker',
            'service_url' => 'https://wajiblapor.kemnaker.go.id/companies/c178cef9-b0ce-428c-bacf-cd9a71af01f2/employment/employees',
            'service_login' => 'pinta_rajagukguk@yahoo.com',
            'service_password' => 'gratiajolowish',
            'description' => 'Daftarkan Pegawai ke platform ini jika sudah lewat masa 3 Bulan Percobaan (Wajib)'
        ]);

        \App\Models\ServiceCredential::create([
            'service_name' => 'BPJS Kesehatan',
            'service_url' => 'https://edabu.bpjs-kesehatan.go.id/',
            'service_login' => 'BU00701559',
            'service_password' => 'Gr@t1aJolowishs',
            'description' => 'Daftarkan Pegawai ke platform ini jika sudah lewat masa 3 Bulan Percobaan (Optional, tanya ms pinta sebelum dimasukkan)'
        ]);

        \App\Models\ServiceCredential::create([
            'service_name' => 'BPJS Ketenagakerjaan (JHT)',
            'service_url' => 'https://sipp.bpjsketenagakerjaan.go.id/',
            'service_login' => 'admin@basic.sch.id',
            'service_password' => 'basic2004',
            'description' => 'Daftarkan Pegawai ke platform ini jika sudah berstatus GTY/PTY'
        ]);
        // Service Credential


        // Goverment Service
        \App\Models\GovermentService::create([
            'service_credential_id' => 1,
            'required_employment_status_id' => 2
        ]);

        \App\Models\GovermentService::create([
            'service_credential_id' => 2,
            'required_employment_status_id' => 2
        ]);

        \App\Models\GovermentService::create([
            'service_credential_id' => 3,
            'required_employment_status_id' => 3
        ]);
        // Goverment Service

        // Religion
        \App\Models\Religion::create([
            'religion_name' => 'Kristen'
        ]);
        // Religion
        
        // Employee
        \App\Models\Employee::create([
            'user_id' => NULL,
            'fullname' => 'Jonathan Christian',
            'id_card' => NULL,
            'place_of_birth' => 'Poso',
            'date_of_birth' => '2000-07-23',
            'sex' => 1,
            'religion_id' => 1,
            'highest_certificate' => NULL,
            'read_employee_rules' => NULL,
            'start_working' => '2021-01-26',
            'end_contract' => '2023-01-25',
            'description' => NULL
        ]);
        \App\Models\Employee::create([
            'user_id' => NULL,
            'fullname' => 'Pinta N Rajagukguk',
            'id_card' => NULL,
            'place_of_birth' => 'Pematang Siantar',
            'date_of_birth' => '1977-10-11',
            'sex' => 0,
            'religion_id' => 1,
            'highest_certificate' => NULL,
            'read_employee_rules' => NULL,
            'start_working' => '2005-07-18',
            'end_contract' => NULL,
            'description' => NULL
        ]);
        // Employee

        // Employee Role
        \App\Models\EmployeeRole::create([
            'employee_id' => 1,
            'role_id' => 2,
            'department_id' => 3,
            'school_level_id' => 5,
            'employment_status_id' => 2,
            'is_active' => true,
            'is_main_role' => true,
            'start' => '2021-01-26',
            'end' => '2023-01-25'
        ]);
        \App\Models\EmployeeRole::create([
            'employee_id' => 2,
            'role_id' => 1,
            'department_id' => 3,
            'school_level_id' => 5,
            'employment_status_id' => 3,
            'is_active' => true,
            'is_main_role' => true,
            'start' => '2005-07-18',
            'end' => NULL
        ]);
        // Employee Role

    }
}
