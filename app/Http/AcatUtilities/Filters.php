<?php
namespace App\Http\AcatUtilities;

Class Filters
{
	protected static $stages = [
		"Latest to Old[Date]" 						=> "LATESTTOOLD",
		"Only VIII" 						=> "ONLYVIII",
		"Only IX"					=> "ONLYIX",
		"Only X"		=> "ONLYX",
		"Only IX and X" 						=> "ONLYIXANDX",
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
