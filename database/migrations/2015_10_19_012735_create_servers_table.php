<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('ip')->unique();
            $table->string('dns')->unique();
            $table->string('user');
            $table->string('password');
            $table->smallInteger('slots');
            $table->smallInteger('max_slots');
            $table->boolean('active')->default(0);
            $table->boolean('active_sales')->default(0);
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
        Schema::drop('servers');
    }
}
