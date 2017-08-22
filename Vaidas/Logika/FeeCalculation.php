<?php namespace Vaidas\Logika;

class FeeCalculation {
	
	function say_hello() {
		return "Hello from Vaidas from class " . get_class($this) . "<br />";
	}

	function cashin($amount) {
		$fee = $amount * 0.003;
		($fee > 5) ? $fee = 5 : $fee;
		return $fee;
	}
}

?>