<?php

class Create_Messages_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('messages', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->string('message');

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
		Schema::drop('messages');
	}

}