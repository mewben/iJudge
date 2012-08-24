<?php 

class Contestant extends Eloquent
{

	public static $timestamps = true;

	public function contest()
	{
		return $this->has_one('Contest');
	}

	public static function rules()
	{
		return array(
			'number' => 'required|numeric',
			'fullname' => 'required',
			'photo' => 'required',
			'contest_id' => 'required|exists:contests,id'
		);
	}

	public static function menu()
	{
		Menu::handler('contestants', array('class'=>'nav nav-list'))
				->raw('Operations', '', array('class'=>'nav-header'))
				->add('contestants/add', 'Add');

		return Menu::handler('contestants')->prefix('admin');
	}
}

 ?>