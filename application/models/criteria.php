<?php 

class Criteria extends Eloquent
{

	public static $timestamps = true;


	public function contest()
	{
		return $this->has_one('Contest');
	}

	public static function rules()
	{
		return array(
			'name' => 'required',
			'percentage' => 'required|numeric|max:100',
			'contest_id' => 'required|exists:contests,id'
		);
	}

	public static function menu()
	{
		Menu::handler('criteria', array('class'=>'nav nav-list'))
				->raw('Operations', '', array('class'=>'nav-header'))
				->add('criteria', 'List of Contests')
				->add('criteria/add', 'Add');

		return Menu::handler('criteria')->prefix('admin');
	}
}

 ?>