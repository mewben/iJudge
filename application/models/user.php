<?php 

class User extends Eloquent
{

	public static $timestamps = true;

	public function roles()
	{
		return $this->has_many_and_belongs_to('Role');
	}

	// authority
	public function has_role($key)
	{
		foreach (Auth::user()->roles as $role) {
			if ($role->slug == $key) {
				return true;
			}
		}
		return false;
	}

	public function has_any_role($keys)
	{
		if (!is_array($keys)) {
			$keys = func_get_args();
		}

		foreach(Auth::user()->roles as $roles) {
			if (in_array($roles->slug, $keys)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Menu builder
	 */
	public static function menu()
	{
		Menu::handler('users', array('class'=>'nav nav-list'))
				->raw('Operations', '', array('class'=>'nav-header'))
				->add('users', 'All Users')
				->add('users/add', 'Add');

		return Menu::handler('users')->prefix('admin');
	}

	public static function rules()
	{
		return array(
			'username' => 'required|unique:users',
			'password' => 'required|confirmed',
			'lastname' => 'required',
		);
	}
}


 ?>