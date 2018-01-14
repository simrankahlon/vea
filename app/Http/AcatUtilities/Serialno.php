<?php
namespace App\Http\AcatUtilities;

Class Serialno
{
	protected static $serialno = [
		"A" 						=> "A",
		"B" 						=> "B",
		
		];

	public static function all() {
		return static::$serialno;
	}

	public static function lookup($code){
		$key = array_search($code, static::$serialno);
		return $key;
	}
}
?>
