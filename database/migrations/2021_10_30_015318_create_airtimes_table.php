<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContactsTable.
 */
class CreateAirtimesTable extends Migration
{
    protected $default_airtimes_table_name = 'airtimes';

    protected $default_airtime_contact_name = 'airtime_contact';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        tap(config('missive.table_names.airtimes', $this->default_airtimes_table_name), function($table_name) {
            Schema::create($table_name, function(Blueprint $table) {
                $table->increments('id');
                $table->string('key')->unique();
                $table->decimal('credits');
                $table->timestamps();
            });
        });

        //TODO: add extra_attributes here
        tap(config('missive.table_names.airtime_contact', $this->default_airtime_contact_name), function($table_name) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('contact_id')->unsigned()->index();
                $table->integer('airtime_id')->unsigned()->index();
                $table->tinyInteger('qty')->unsigned()->default(1);
                $table->timestamps();
                $table->foreign('airtime_id')->references('id')->on('airtimes')->onDelete('cascade');
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
        tap(config('missive.table_names.airtime_contact', $this->default_airtime_contact_name), function($table_name) {
            Schema::dropIfExists($table_name);
        });

        tap(config('missive.table_names.airtimes', $this->default_airtimes_table_name), function($table_name) {
            Schema::drop($table_name);
        });
    }
}
