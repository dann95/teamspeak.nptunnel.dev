<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedRespawnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_respawns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tibia_list_id');
            $table->unsignedInteger('respawn_id');
            $table->smallInteger('state');
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
        Schema::drop('assigned_respawns');
    }
}
