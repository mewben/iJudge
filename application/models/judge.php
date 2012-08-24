<?php 

class Judge extends Eloquent
{

	public static $timestamps = true;

	public function contest()
	{
		return $this->has_one('Contest');
	}

	public static function rules()
	{
		return array(
			'username' => 'required',
			'password' => 'required',
			'number' => 'required|numeric',
			'contest_id' => 'required|exists:contests,id'
		);
	}
}

 ?>