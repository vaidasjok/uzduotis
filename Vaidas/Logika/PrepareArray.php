<?php namespace Vaidas\Logika;

class PrepareArray {

	const USD = 1.1497;
	const JPY = 129.53;


	// gets array values for each entity in euros: count of transactions per week and amount of transactions
	// per week.
	function array_get_count_and_amount_eur_a_week(array $initial_data, $id, $date ) {
		$count = 0;
		(double) $amount_a_week = 0;
		foreach($initial_data as $data) {
			if ($data[1] == $id) {
				// finding the time interval for a current week.
				if(strtotime($data[0]) > strtotime('last monday', strtotime($date)) && strtotime($data[0]) <= strtotime($date)) {
					//counting number of transactions during the current week.
					$count++;

					// calculating the amount of transactions during the current week in euros.
					switch ((string) trim($data[5])) {
						case 'EUR':
							$amount_a_week += (double) $data[4];
							break;
						case 'JPY':
							$amount_a_week += ((double) $data[4] / self::JPY);
							break;
						case 'USD':
							$amount_a_week += ((double) $data[4] / self::USD);
							break;

					}
				}
			}		
		}
		return [$count, $amount_a_week];
	}



// adding calculated data by array_get_count_and_amount_eur_a_week() to initial array
	function add_columns(array $initial_data) {
		$result_array = [];
		foreach($initial_data as $data) {
			$result = $this->array_get_count_and_amount_eur_a_week($initial_data, $data[1], $data[0]);
		
			array_push($data, $result[0]);
			array_push($data, $result[1]);
			array_push($result_array, $data);
		}
		return $result_array;

	}









}
?>