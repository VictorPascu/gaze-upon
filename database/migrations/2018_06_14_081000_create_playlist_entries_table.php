<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_entries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('playlist_definition_id');
            $table->unsignedInteger('playable_item_id');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

           // $table->foreign('playlist_definition_id')->references('id')->on('playlist_definitions');
            //$table->foreign('playable_item_id')->references('id')->on('playable_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_entries');
    }
}
