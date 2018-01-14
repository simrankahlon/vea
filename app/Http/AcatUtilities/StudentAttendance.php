<?php
namespace App\Http\AcatUtilities;

Class StudentAttendance
{
	protected static $attendance = [
		"Present" 						=> "PRESENT",
		"Absent" 						=> "ABSENT",
		"Late"                          => "LATE",
		];

	public static function all() {
		return static::$attendance;
	}

	public static function lookup($code){
		$key = array_search($code, static::$attendance);
		return $key;
	}
}
?>
