<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_number');
            $table->string('purpose_of_contact');
            $table->string('join_team')->nullable();
            $table->string('join_event')->nullable();
            $table->string('reason_of_joining_event')->nullable();
            $table->longText('message');
            $table->boolean('read');
            $table->integer('assigned_id');
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
        Schema::dropIfExists('messages');
    }
}
