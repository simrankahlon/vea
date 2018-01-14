<?php
namespace App\Http\AcatUtilities;

Class Standard
{
	protected static $stages = [
		"VIII" 						=> "VIII",
		"IX"					=> "IX",
		"X"		=> "X",
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