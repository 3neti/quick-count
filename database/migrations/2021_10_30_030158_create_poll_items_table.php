<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_id')->index()->nullable();
            $table->unsignedBigInteger('candidate_id')->index()->nullable();
            $table->unsignedInteger('votes');
            $table->timestamps();
            $table->foreign('poll_id')->references('id')->on('polls');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->unique(['id', 'poll_id', 'candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_items');
    }
}
