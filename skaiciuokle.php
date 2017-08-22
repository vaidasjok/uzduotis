<?php 
require_once("start.php"); 
use Vaidas\Logika\FeeCalculation as FeeCalculation;
use Vaidas\Logika\PrepareArray as PrepareArray;


// DUOMENU RENGIMAS

// pradiniai failo input.csv duomenys issaugomi array forma
if (defined('STDIN')) {
	$initial_data = [];
	while($f = fgets(STDIN)){
		$to_array = explode(',', $f);

	    array_push($initial_data, $to_array);
	}
}

// prie pradinio array paskaiciuojami ir pridedami papildomi duomenu stulpeliai su savaites operaciju
// skaiciumi ir savaites operacijos bendra isemimo suma. Tai atliekama PrepareArray klases metodu pagalba.
// Tai daroma tam, kad supaprastinti skaiciavimu procesa (jie atliekami tik tarp masyvo stulpeliu).
$prepare = new PrepareArray();
$prepared_array = $prepare->add_columns($initial_data);
echo print_r($prepared_array);

// # DUOMENU RENGIMO PABAIGA





// KOMISINIU SKAICIAVIMAS

$fees = [];
foreach($initial_data as $duomuo) {
	$skaic = new FeeCalculation;
	if ($duomuo[3] == "cash_in") {
		array_push($fees, $skaic->cashin($duomuo[4]));

	} elseif ($duomuo[3] == "cash_out") {
		array_push($fees, "-");
	}
}
echo print_r($fees);


/*
foreach($duomenys as $duomuo) {
	fwrite(STDOUT, $duomuo);
}
*/







?>

