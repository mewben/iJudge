<?php 

class Contest extends Eloquent
{

	public static $timestamps = true;


	public function criteria()
	{
		return $this->has_many('Criteria');
	}

	public static function rules()
	{
		return array(
			'name' => 'required'
		);
	}

	public static function selectContests()
	{
		$records = Contest::where('active', '=', '1')
					->order_by('name', 'asc')
					->get();

		$res = array('0' => '-Select from Contests-');
		foreach ($records as $key => $value) {
			$res[$value->id] = $value->name;
		}
		return $res;
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

		Schema::create('judges', function($table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->integer('number');
			$table->string('fullname');
			$table->string('photo');
			$table->integer('contest_id');
			$table->timestamps();
		});

		Schema::create('contestants', function($table) 
		{
			$table->increments('id');
			$table->integer('number');
			$table->string('fullname');
			$table->string('photo');
			$table->integer('contest_id');
			$table->boolean('active');
			$table->timestamps();
		});
	}

	public static function unsetup()
	{
		Schema::drop('contests');
		Schema::drop('criteria');
		Schema::drop('judges');
		Schema::drop('contestants');
	}
}

 ?>