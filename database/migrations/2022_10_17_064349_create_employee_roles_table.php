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
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('school_level_id')->constrained('school_levels');
            $table->foreignId('employment_status_id')->constrained('employment_statuses');
            $table->foreignId('start')->nullable();
            $table->foreignId('end')->nullable();
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
