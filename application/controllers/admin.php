<?php 

class Admin_Controller extends Base_Controller
{
	public $restful = true;
	public $layout = 'templates.backend';
	public $access = array('admin');

	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'auth')->except(array('login', 'setup'));
		$this->filter('before', 'myAuth:'.implode('.', $this->access))->except(array('login', 'logout', 'password'));
	}

	public function get_index()
	{
		$this->layout->title = "HELLO WORLD";
		$this->layout->content = View::make('admin.questions.index');
	}

	public function get_dashboard()
	{
		$this->layout->title = "Dashboard";
		$this->layout->topmenu = $this->menu();
		//$this->layout->sidemenu = $this->sidemenu();

		$this->layout->content = View::make('admin.dashboard');
	}

	public function get_login()
	{
		return View::make('admin.login');
	}

	public function post_login()
	{
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'remember' => true,
		);

		if (Auth::attempt($credentials)) {
			return Redirect::to('admin/dashboard');
/*			if (Auth::user()->has_role('admin')) {
				return Redirect::to('admin/dashboard');
			} else if (Auth::user()->has_role('member')) {
				if(Auth::user()->active != '1') {
					Session::flash('error', 'This user has been expired.');
					return Redirect::to('admin/login');
				} 
				return Redirect::to('members/dashboard');
			}
			return Response::error('401');*/
		} else {
			Session::flash('error', 'Invalid user/password.');
			return Redirect::to('admin/login');
		}
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}

	public function get_password()
	{
		$v = new Members_Controller();
		$member = false;
		if (Auth::user()->has_role('member')) {
			$this->layout->topmenu = $v->menu();
			$this->layout->sidemenu = $v->sidemenu();
			$member = true;
		} else {
			$this->layout->topmenu = self::menu();
			$this->layout->sidemenu = self::sidemenu();
		}

		$this->layout->title = 'Change admin password';
		$this->layout->content = View::make('admin.password')->with('member', $member);
	}

	public function post_password()
	{
		$rules = array(
			'current' => 'required',
			'password' => 'required|confirmed',
		);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/password')
				->with_errors($validation)
				->with_input();
		} else {
			if (Hash::check(Input::get('current'), Auth::user()->password )) {
					$q = User::find(Auth::user()->id);
					$q->password = Hash::make(Input::get('password'));
					$q->save();
					Session::flash('message', 'Password successfuly updated.');
			} else {
				Session::flash('error', 'Incorrect Password');
			}
			return Redirect::to('admin/password');
		}
	}

	/**
	 * Menu builder
	 */
	public function menu()
	{
		$manage = Menu::items(array('class' => 'dropdown-menu'))
				->add('contests', 'Contests')
				->add('chapters', 'Manage Chapters')
				->add('users', 'Manage Users')
				->add('settings', 'Settings');

		Menu::handler('admin', array('class' => 'nav pull-right'))
				->add('dashboard', 'Dashboard')
				->add('#', '<i class="icon-cog icon-white"></i> Manage <b class="caret"></b>', $manage, array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown'));

		$account = Menu::items(array('class'=>'dropdown-menu'))
				->add('statistics', 'Statistics')
				->add('password', 'Change Password')
				->add('logout', 'Log out');

		Menu::handler('admin')
				->add('#', '<i class="icon-user icon-white"></i> Admin <b class="caret"></b>', $account, array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown'));

		//echo Menu::handler('admin')->render(array('class'=>'nav pull-right'));


		return Menu::handler('admin')->prefix('admin');
	}

	public function sidemenu()
	{
		Menu::handler('adminside', array('class'=>'nav nav-list'))
				->raw('Operations', '', array('class'=>'nav-header'))
				->add('dashboard', 'Dashboard')
				->add('password', 'Change password')
				->raw('', '', array('class'=>'divider'))
				->add('logout', 'Log out');

		return Menu::handler('adminside')->prefix('admin');
	}
}
 ?>