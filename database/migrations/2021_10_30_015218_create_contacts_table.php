<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContactsTable.
 */
class CreateContactsTable extends Migration
{
	protected $default_table_name = 'contacts';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		tap(config('missive.table_names.contacts', $this->default_table_name), function($table_name) {
			Schema::create($table_name, function(Blueprint $table) {
	            $table->increments('id');
	            $table->string('mobile')->unique();
	            $table->string('handle')->nullable()->index();
                $table->schemalessAttributes('extra_attributes');
                $table->timestamp('verified_at')->nullable();
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
		tap(config('missive.table_names.contacts', $this->default_table_name), function($table_name) {
			Schema::drop($table_name);
		});
	}
}
