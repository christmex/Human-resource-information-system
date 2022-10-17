<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'super admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('mantapjiwa00'),
        ]);

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
            'description' => 'Pegawai yang baru '
        ]);

        \App\Models\EmploymentStatus::create([
            'employment_status' => 'GTTY/PTTY',
            'description' => 'Pegawai/Guru Tidak Tetap, umumnya status ini diberikan jika pegawai telah selesai melewati masa percobaan selama 3 bulan plus kinerja yang baik'
        ]);

        \App\Models\EmploymentStatus::create([
            'employment_status' => 'GTY/PTY',
            'description' => 'Pegawai/Guru Tetap, umumnya status ini diberikan jika minimal 2 tahun masa kontrak plus kinerja yang baik, jika kinerja kurang bagus maka kemungkinan pegawai akan dilanjutkan dengan pkwt, di kasus lain, ada pegawai yang tidak perlu menunggu 2 tahun untuk menjadi Pegawai/Guru Tetap'
        ]);

        // Employment Status


        // Goverment Service
        \App\Models\GovermentService::create([
            'goverment_service_name' => 'BPJS Kesehatan',
            'required_employment_status_id' => 2
        ]);

        \App\Models\GovermentService::create([
            'goverment_service_name' => 'Wajib Lapor Kemnaker',
            'required_employment_status_id' => 2
        ]);

        \App\Models\GovermentService::create([
            'goverment_service_name' => 'BPJS Ketenagakerjaan (JHT)',
            'required_employment_status_id' => 3
        ]);
        // Goverment Service


    }
}
