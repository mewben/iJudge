<?php 

class Admin_Criteria_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/criteria';
	public $vie = 'admin.criteria';

	public function get_contest($id)
	{
		if (Request::ajax()) {
			
			return View::make($this->vie. '.criteriax');
		} else {
			//return View::make($this->vie. '.criteria');
		}
	}

	public function get_add($contest_id)
	{
		if (Request::ajax()) {
			return View::make($this->vie. '.addx')->with('ajax', true);
		}
	}
}

