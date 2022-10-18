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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('fullname');
            $table->string('id_card')->nullable()->unique();
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->boolean('sex');
            $table->foreignId('religion_id')->constrained();
            $table->string('highest_certificate')->nullable();
            $table->date('start_working');
            $table->date('end_contract')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
