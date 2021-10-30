<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTopupsTable.
 */
class CreateTopupsTable extends Migration
{
    protected $default_table_name = 'topups';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        tap(config('missive.table_names.topups', $this->default_table_name), function($table_name) {
            Schema::create($table_name, function(Blueprint $table) {
                $table->increments('id');
                $table->integer('contact_id')->unsigned()->index();
                $table->decimal('amount');
                $table->timestamps();
                $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
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
        tap(config('missive.table_names.topups', $this->default_table_name), function($table_name) {
            Schema::drop($table_name);
        });
    }
}
