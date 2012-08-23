<?php 

class Admin_Criteria_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/criteria';
	public $vie = 'admin.criteria';

	public function get_contest($id)
	{
		$data = Contest::find($id);
		$records = Criteria::where('contest_id', '=', $id)->get();
		if (Request::ajax()) {
			return View::make($this->vie. '.criteriax')
				->with('criteria', $records)
				->with('data', $data);
		} else {
			//return View::make($this->vie. '.criteria');
		}
	}

	public function get_add($id) // $id -> contest_id
	{
		$contest = Contest::find($id);
		$contests = Contest::selectContests();

		if (Request::ajax()) {
			return View::make($this->vie. '.addx')
				->with('contest', $contest)
				->with('contests', $contests)
				->with('ajax', true);
		}
	}

	public function get_edit($id) // $id -> criteria_id
	{
		if (! $record = Criteria::find($id)) {
			return false;
		}
		$contest = Contest::find($record->contest_id);
		$contests = Contest::selectContests();
		if (Request::ajax()) {
			return View::make($this->vie . '.addx')
				->with('ajax', true)
				->with('contest', $contest)
				->with('contests', $contests)
				->with('data', $record);
		}
	}

	public function post_add()
	{
		if (Request::ajax()) {
			$validation = Validator::make(Input::all(), Criteria::rules());
			if ($validation->fails()) {
				return false;
			} else {
				
				Criteria::create(array(
					'name' => Input::get('name'),
					'description'=> Input::get('description'),
					'percentage' => Input::get('percentage'),
					'contest_id' => Input::get('contest_id'),
					'criteria_contest_id' => Input::get('select_criteria')
				));
				return true;
			}
		}
	}

	public function post_edit()
	{
		$validation = Validator::make(Input::all(), Criteria::rules());
		if ($validation->fails()) {
			return false;
		} else {
			try {
				$record = Criteria::find(Input::get('id'));
				$data = array(
					'name' => Input::get('name'),
					'description'=> Input::get('description'),
					'percentage' => Input::get('percentage'),
					'contest_id' => Input::get('contest_id'),
					'criteria_contest_id' => Input::get('select_criteria')
				);

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
			if (! $record = Criteria::find($id)) {
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

