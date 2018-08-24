<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('status');
            $table->integer('user_id');
            $table->integer('playlist_definition_id');
            $table->integer('playable_item_now_playing_id');
            $table->integer('playable_entry_now_playing_id');
            $table->timestamp('now_playing_started_at');
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
        Schema::dropIfExists('feeds');
    }
}
