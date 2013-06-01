<?php

// Sample file for fetching API data from DB

require('./class.epa.php');
$epa = new Epa();

$result_data = $epa->get_by_zip($_REQUEST['zip']);

echo '<pre>';
foreach ($result_data as $k => $v) {
	print_r($v); // Uncomment to display all data
	// echo $v['PWSNAME'] . "\n"; // Display a single column
}

echo "\n\nDone\n\n";

?>