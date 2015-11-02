<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_bots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vserver_id');
            $table->boolean('auto_afk');
            $table->smallInteger('max_afk_time');
            $table->smallInteger('afk_ch_id');
            $table->boolean('tibia_list');
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
        Schema::drop('ts_bots');
    }
}
