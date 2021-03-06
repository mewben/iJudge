<?php 

class Admin_Contests_Controller extends Admin_Controller
{
	public $restful = true;
	public $rout = 'admin/contests';
	public $vie = 'admin.contests';

	public function __construct()
	{
		parent::__construct();
		$this->layout->topmenu = $this->menu();
		$this->layout->sidemenu = Contest::menu();
	}

	public function get_index()
	{
		$data = Contest::order_by('name')->get();
		$this->layout->content = View::make($this->vie . '.index')->with('data', $data);	
	}

	public function get_add()
	{
		$this->layout->content = View::make($this->vie . '.add');
	}

	public function post_add()
	{
		$validation = Validator::make(Input::all(), Contest::rules());
		if ($validation->fails()) {
			Session::flash('error', 'Error processing. Please comply the requirements.');
			return Redirect::to($this->rout . '/add')
				->with_errors($validation)
				->with_input();
		} else {
			Contest::create(array(
				'name' => Input::get('name'),
				'banner'=> Input::get('banner'),
				'dependent' => Input::get('dependent', '0'),
				'active' => '1'
			));
			Session::flash('message', 'Contest added successfully.');
			return Redirect::to($this->rout);
		}
	}

	public function get_edit($id)
	{
		if (! $record = Contest::find($id)) {
			return Redirect::to($this->rout);
		}
		$this->layout->title = 'Edit Contest';
		
		$this->layout->content = View::make($this->vie . '.add')
			->with('data', $record);
	}

	public function post_edit()
	{
		$validation = Validator::make(Input::all(), Contest::rules());
		if ($validation->fails()) {
			return Redirect::to($this->rout. '/edit/'.Input::get('id'))
				->with_errors($validation)
				->with_input();
		} else {
			try {
				$record = Contest::find(Input::get('id'));
				$data = array(
					'name' => Input::get('name'),
					'dependent' => Input::get('dependent', '0')
				);
				if (Input::get('banner')) {
					$data['banner'] = Input::get('banner');
				}
				$record->fill($data);
				$record->save();

				Session::flash('message', 'Contest edited successfully');
				return Redirect::to($this->rout);
			} catch (Exception $e) {
				die($e);
			}
		}
	}

	public function get_active($id, $value = 1)
	{
		if (Request::ajax()) {
			if (! $record = Contest::find($id)) {
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