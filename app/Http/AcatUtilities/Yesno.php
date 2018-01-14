<?php
namespace App\Http\AcatUtilities;

Class Yesno
{
	protected static $yesno = [
		"Yes" 						=> 1,
		"No" 						=> 0,
		
		];

	public static function all() {
		return static::$yesno;
	}

	public static function lookup($code){
		$key = array_search($code, static::$yesno);
		return $key;
	}
}
?>
