<?php
namespace App\Http\AcatUtilities;

Class PaymentMode
{
	protected static $paymentmode = [
		"Cash" 						=> "CASH",
		"Cheque" 					=> "CHEQUE",
		"Online Payment"            => "ONLINEPAYMENT",  
		
		];

	public static function all() {
		return static::$paymentmode;
	}

	public static function lookup($code){
		$key = array_search($code, static::$stages);
		return $key;
	}
}
?>
