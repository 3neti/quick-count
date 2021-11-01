<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('cluster')->index();
            $table->string('place')->nullable()->index();
            $table->string('barangay')->nullable()->index();
            $table->string('municity')->nullable()->index();
            $table->string('district')->nullable()->index();
            $table->string('province')->nullable()->index();
            $table->string('region')->nullable()->index();
            $table->string('island')->nullable()->index();
            $table->unique(['municity', 'cluster']);
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
        Schema::dropIfExists('stations');
    }
}
