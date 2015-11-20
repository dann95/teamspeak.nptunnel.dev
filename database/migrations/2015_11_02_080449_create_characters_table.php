<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tibia_list_id');
            $table->boolean('online');
            $table->dateTime('online_since');
            $table->boolean('wasDeleted')->default(0);
            $table->smallInteger('position');
            $table->unsignedInteger('vocation_id');
            $table->unsignedInteger('world_id');
            $table->string('residence');
            $table->string('last_death');
            $table->smallInteger('register_lvl');
            $table->smallInteger('lvl');
            $table->string('name');
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
        Schema::drop('characters');
    }
}
