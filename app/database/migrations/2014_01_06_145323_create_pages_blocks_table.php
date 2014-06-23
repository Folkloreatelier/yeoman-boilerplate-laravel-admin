<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages_blocks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('page_id')->index();
			$table->string('type',50);
			$table->string('area',50)->index();
			$table->smallInteger('order')->index();
			$table->longText('data');
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
		Schema::drop('pages_blocks');
	}

}
