<?php 

class Setting extends Eloquent
{
	public static $timestamps = true;

	public static function getSettings()
	{
		$record = self::all();
		$res = array();
		foreach ($record as $key => $value) {
			$res[$value->setting] = $value->value;
		}
		return $res;
	}
}