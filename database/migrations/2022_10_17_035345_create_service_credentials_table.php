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
            $table->string('service_name')->unique();
            $table->string('service_url');
            $table->string('service_login');
            $table->string('service_password');
            $table->string('css_class')->nullable();
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
