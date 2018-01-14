<?php
namespace App\Http\AcatUtilities;

Class Schools
{
	protected static $stages = [
		"Billabong" 						=> "BILLAB",
		"Bombay Scottish"					=> "BSCOTT",
		"EURO"		=> "EURO",
		"G.S. Shetty"	=> "GSSHETTY",
		"Gopal Sharma"				=> "GSHARMA",
		"HFS(Powai)"				=> "HFSPPOWAI",
		"HFS(Thane)"				=> "HFSTHANE",
		"JK Singhania"				=> "JKSIN",
		"NES"				=> "NES",
		"PPS(Bhandup)"				=> "PPSBHA",
		"PPS(Chandivili)"				=> "PPSCH",
		"SSRVM"				=> "SSRVM",
		"Universal"				=> "UNI",
		"VPM"				=> "VPM",
		"Others"            =>"OTHERS",
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