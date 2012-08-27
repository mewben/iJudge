<?php 

class Admin_Settings_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/settings';
	public $vie = 'admin.settings';

	public function __construct()
	{
		parent::__construct();
		$this->layout->topmenu = $this->menu();
		//$this->layout->sidemenu = Contestant::menu();
	}

	public function get_index()
	{
		$data = Setting::getSettings();
		$this->layout->title = "Settings";
		$this->layout->otherhead = true; // for redactor js
		$this->layout->content = View::make($this->vie)->with('data', $data);
	}

	public function post_save()
	{
		if (Input::get('type')) {
			$record =Setting::where('setting', '=', 'type')->first();
			if ($record) {
				$record->value = Input::get('type');
				$record->save();
			}			
		}
		$record = Setting::where('setting', '=', 'resultform')->first();
		if ($record) {
			$record->value = Input::get('result_form');
			$record->save();
		}
		return Redirect::to('admin/settings');
	}

	public function get_view($id) // contest_id
	{
		$contests = Contest::selectContests(); // for select
		$data = Contestant::where('contest_id', '=', $id)->order_by('number', 'asc')->get();
		$this->layout->title = "Contestants";
		$this->layout->content = View::make($this->vie . '.view')
					->with('contests', $contests)
					->with('contest_id', $id)
					->with('data', $data);
	}

	public function get_add($id) // contest_id
	{
		$contest = Contest::find($id);
		return View::make($this->vie . '.add')->with('contest', $contest);
	}

	public function post_add()
	{
		$validation = Validator::make(Input::all(), Contestant::rules());
		if ($validation->fails()) {
			return false;
		} else {
			Contestant::create(array(
				'number' => Input::get('number'),
				'fullname'=> Input::get('fullname'),
				'photo' => Input::get('photo'),
				'contest_id' => Input::get('contest_id'),
				'active' => '1'
			));
			return true;
		}
	}

	public function get_edit($id) //contestant_id
	{
		if (! $record = Contestant::find($id)) {
			return false;
		}
		$contest = Contest::find($record->contest_id);
		return View::make($this->vie . '.add')
			->with('contest', $contest)
			->with('data', $record);
	}

	public function post_edit()
	{
		$rules = Contestant::rules();
		unset($rules['photo']);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return false;
		} else {
			try {
				$record = Contestant::find(Input::get('id'));
				$data = array(
					'number' => Input::get('number'),
					'fullname'=> Input::get('fullname'),
					'contest_id' => Input::get('contest_id'),
					'active' => '1'
				);
				if (Input::get('photo')) {
					$data['photo'] = Input::get('photo');
				}
				$record->fill($data);
				$record->save();

				return true;
			} catch (Exception $e) {
				return false;
			}
		}
	}

	public function get_delete($id) // contestant_id
	{
		if (Request::ajax()) {
			if (! $record = Contestant::find($id)) {
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

	public function get_active($id, $value = 1)
	{
		if (Request::ajax()) {
			if (! $record = Contestant::find($id)) {
				return false;
			} else {
				$data = array(
					'active' => $value
				);
				$record->fill($data);
				$record->save();
				return true;
			}
		}
	}
}