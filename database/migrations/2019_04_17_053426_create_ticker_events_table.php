<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickerEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticker_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('match_id');
            $table->boolean('yellow_card');
            $table->boolean('red_card');
            $table->boolean('injury');
            $table->boolean('assist');
            $table->boolean('goal');
            $table->boolean('substitute');
            $table->string('title');
            $table->string('description');
            $table->integer('minute_of_event');
            $table->integer('player_id');
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
        Schema::dropIfExists('ticker_events');
    }
}
