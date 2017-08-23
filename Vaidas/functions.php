<?php

	function round_up ($value, $places=0) {
	  if ($places < 0) { $places = 0; }
	  $mult = pow(10, $places);
	  return ceil($value * $mult) / $mult;
	}

?>