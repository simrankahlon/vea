<?php
namespace App\Http\AcatUtilities;

Class Attendance
{
	protected static $stages = [
		"Present" 						=> "PRESENT",
		"Absent" 						=> "ABSENT",
		
		];

	public static function all() {
		return static::$stages;
	}

	public static function lookup($code){
		$key = array_search($code, static::$stages);
		return $key;
	}
}
?>
