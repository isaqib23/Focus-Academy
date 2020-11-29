<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateVideoUploadersTable.
 */
class CreateVideoUploadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_uploaders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file_path');
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
		Schema::drop('video_uploaders');
	}
}
