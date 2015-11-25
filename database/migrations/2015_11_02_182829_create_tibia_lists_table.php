<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTibiaListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tibia_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('world_id')->default(1);
            $table->unsignedInteger('ts_bot_id');
            $table->smallInteger('friend_ch_id');
            $table->smallInteger('enemy_ch_id');
            $table->smallInteger('neutral_ch_id');
            $table->boolean('default_msg_die');
            $table->boolean('default_poke_die');
            $table->boolean('show_rashid')->default(0);
            $table->boolean('show_blue')->default(0);
            $table->boolean('show_green')->default(0);
            $table->boolean('show_resp_numbers')->default(0);
            $table->boolean('show_tibia_map')->default(0);
            $table->unsignedInteger('rashid_ch_id');
            $table->unsignedInteger('blue_ch_id');
            $table->unsignedInteger('green_ch_id');
            $table->unsignedInteger('resp_ch_id');
            $table->unsignedInteger('tibia_map_id');
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
        Schema::drop('tibia_lists');
    }
}
