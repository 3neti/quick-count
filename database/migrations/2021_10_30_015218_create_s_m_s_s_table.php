<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSMSsTable.
 */
class CreateSMSsTable extends Migration
{
    protected $default_table_name = 's_m_s_s';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        tap(config('missive.table_names.smss', $this->default_table_name), function($table_name) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->increments('id');
                $table->string('from');
                $table->string('to');
                $table->text('message')->nullable();
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        tap(config('missive.table_names.smss', $this->default_table_name), function($table_name) {
            Schema::dropIfExists($table_name);
        });
    }
}
