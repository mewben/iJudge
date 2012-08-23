<?php 

class Admin_Criteria_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/criteria';
	public $vie = 'admin.criteria';

	public function get_contest($id)
	{
		$data = Contest::find($id);
		if (Request::ajax()) {
			return View::make($this->vie. '.criteriax')
				->with('data', $data);
		} else {
			//return View::make($this->vie. '.criteria');
		}
	}

	public function get_add($id)
	{
		$contest = Contest::find($id);
		if (Request::ajax()) {
			return View::make($this->vie. '.addx')
				->with('contest', $contest)
				->with('ajax', true);
		}
	}

	public function post_add()
	{
		if (Request::ajax()) {
			
		}
	}
}

