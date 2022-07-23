<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->date('date_of_birth');
            $table->date('joined_date');
            $table->boolean('gender')->nullable();
            $table->string('username');
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->string('location');
            $table->integer('state')->default(0); // check validate 0 = new , 1 = active , -1 = disabled`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
