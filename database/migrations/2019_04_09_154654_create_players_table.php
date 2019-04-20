<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('playerNumber');
            $table->string('playerPosition');
            $table->integer('age');
            $table->integer('team_id');
            $table->integer('total_goals');
            $table->integer('yellow_cards');
            $table->integer('red_cards');
            $table->integer('assists');
            $table->date('date_joined');
            $table->string('image');
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
        Schema::dropIfExists('players');
    }
}
