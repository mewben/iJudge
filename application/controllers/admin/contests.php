<?php 

class Admin_Contests_Controller extends Admin_Controller
{
	public $restful = true;

	public function __construct()
	{
		parent::__construct();
		$this->layout->topmenu = $this->menu();
		$this->layout->sidemenu = Contest::menu();
	}

	public function get_index()
	{
		$data = null;
		$this->layout->content = View::make('admin.contests.index')->with('data', $data);	
	}

	public function get_add()
	{
		$this->layout->content = View::make('admin.contests.add');
	}
}