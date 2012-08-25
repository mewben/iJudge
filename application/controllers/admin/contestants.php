<?php 

class Admin_Contestants_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/contestants';
	public $vie = 'admin.contestants';

	public function __construct()
	{
		parent::__construct();
		$this->layout->topmenu = $this->menu();
		//$this->layout->sidemenu = Contestant::menu();
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
}