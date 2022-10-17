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
        Schema::create('service_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('serivce_name')->unique();
            $table->string('serivce_url');
            $table->string('serivce_login');
            $table->string('serivce_password');
            $table->text('description');
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
        Schema::dropIfExists('service_credentials');
    }
};
