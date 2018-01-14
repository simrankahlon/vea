<?php
namespace App\Http\AcatUtilities;

Class Branch
{
	protected static $stages = [
		"Bhandup" 						=> "BHANDUP",
		"Mulund" 						=> "MULUND",
		
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
