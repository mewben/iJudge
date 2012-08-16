<?php 

class Contest extends Eloquent
{

	public static $timestamps = true;


	public function criteria()
	{
		return $this->has_many('Criteria');
	}

	public static function menu()
	{
		Menu::handler('contests', array('class'=>'nav nav-list'))
				->raw('Operations', '', array('class'=>'nav-header'))
				->add('contests', 'List of Contests')
				->add('contests/add', 'Add');

		return Menu::handler('contests')->prefix('admin');
	}

	public static function setup()
	{
		Schema::create('contests', function($table)
		{
			$table->increments('id');
			$table->string('name')->index();
			$table->string('banner');
			$table->boolean('active');
			$table->boolean('dependent');
			$table->timestamps();
		});

		Schema::create('criteria', function($table)
		{
			$table->increments('id');
			$table->string('name')->index();
			$table->string('description');
			$table->integer('percentage');
			$table->integer('contest_id');
			$table->integer('criteria_contest_id');
			$table->timestamps();
		});
	}

	public static function unsetup()
	{
		Schema::drop('contests');
		Schema::drop('criteria');
	}
}

 ?>