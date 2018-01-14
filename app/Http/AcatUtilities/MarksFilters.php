<?php
namespace App\Http\AcatUtilities;

Class MarksFilters
{
	protected static $filters = [
		"Lowest to Highest" 						=> "LTOH",
		"Highest to Lowest" 						=> "HTOL",
		"Default (Alphabetically)"					=> "Default",
		];

	public static function all() {
		return static::$filters;
	}

	public static function lookup($code){
		$key = array_search($code, static::$filters);
		return $key;
	}
}
?>
