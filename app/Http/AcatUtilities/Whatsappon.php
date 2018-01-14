<?php
namespace App\Http\AcatUtilities;

Class Whatsappon
{
	protected static $stages = [
		
		"Father's Cell" 						=> "FCELL",
		"Mother's Cell" 						=> "MCELL",
		
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
