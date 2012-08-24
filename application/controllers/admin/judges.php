<?php 

class Admin_Judges_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/judges';
	public $vie = 'admin.judges';

	public function get_contest($id)
	{
		$data = Contest::find($id);
		$records = Judge::where('contest_id', '=', $id)->order_by('number', 'asc')->get();
		if (Request::ajax()) {
			return View::make($this->vie. '.index')
				->with('judges', $records)
				->with('data', $data);
		} else {
			//return View::make($this->vie. '.criteria');
		}
	}

	public function get_add($id) // $id -> contest_id
	{
		$contest = Contest::find($id);

		if (Request::ajax()) {
			return View::make($this->vie. '.add')
				->with('contest', $contest)
				->with('ajax', true);
		}
	}

	public function get_edit($id) // $id -> criteria_id
	{
		if (! $record = Judge::find($id)) {
			return false;
		}
		$contest = Contest::find($record->contest_id);
		if (Request::ajax()) {
			return View::make($this->vie . '.add')
				->with('ajax', true)
				->with('contest', $contest)
				->with('data', $record);
		}
	}

	public function post_add()
	{
		if (Request::ajax()) {
			$validation = Validator::make(Input::all(), Judge::rules());
			if ($validation->fails()) {
				return false;
			} else {
				
				Judge::create(array(
					'username' => Input::get('username'),
					'password'=> Hash::make(Input::get('password')),
					'number' => Input::get('number'),
					'fullname' => Input::get('fullname'),
					'contest_id' => Input::get('contest_id')
				));
				return true;
			}
		}
	}

	public function post_edit()
	{
		$rules = Judge::rules();
		unset($rules['password']);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return false;
		} else {
			try {
				$record = Judge::find(Input::get('id'));
				$data = array(
					'username' => Input::get('username'),
					'number' => Input::get('number'),
					'fullname' => Input::get('fullname'),
					'contest_id' => Input::get('contest_id')
				);

				if (Input::get('password')) {
					$data['password'] = Hash::make(Input::get('password'));
				}

				$record->fill($data);
				$record->save();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
	}

	public function get_delete($id)
	{
		if (Request::ajax()) {
			if (! $record = Judge::find($id)) {
				return false;
			} else {
				try {
		        	$record->delete();
		            return true;
				} catch (Exception $e) {
					return false;
				}
			}
		}
	}
}

