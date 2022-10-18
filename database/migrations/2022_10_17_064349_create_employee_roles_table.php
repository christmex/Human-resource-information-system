<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('role_id')->constrained('roles');
            // $table->foreignId('department_id')->constrained('departments')->nullable();
            // $table->foreignId('school_level_id')->constrained('school_levels')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('school_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('employment_status_id')->constrained('employment_statuses');
            $table->boolean('is_active')->nullable()->default(true);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
};
