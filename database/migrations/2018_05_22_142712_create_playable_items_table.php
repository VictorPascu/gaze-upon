<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayableItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playable_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('type_id');
            $table->string('name');
            $table->string('duration');
            $table->string('path');
            $table->timestamps();

            //$table->foreign('type_id')->references('id')->on('playable_item_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playable_items');
    }
}
