<?php

class Create_Relations_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('relations', function($table)
		{
			$table->increments('id');

			$table->integer('leader');
			$table->integer('follower');

			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('relations');
	}

}