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
            $table->string('title');
            $table->longText('description');
            $table->integer('minute_of_event');
            $table->integer('player_idHome')->nullable();
            $table->string('playerNameAway')->nullable();
            $table->boolean('yellow_card')->nullable();
            $table->boolean('red_card')->nullable();
            $table->boolean('injury')->nullable();
            $table->boolean('assist')->nullable();
            $table->boolean('goal')->nullable();
            $table->boolean('substitute')->nullable();
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
