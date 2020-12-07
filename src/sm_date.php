<?php


if($_SERVER['REQUEST_METHOD'] == 'GET') {
	header("Content-Type: application/json");
	date_default_timezone_set('Europe/Kiev');

	//value that we need to send in request, like https://somehosting.xmp/sm_date.php?BDdate=31.12
	$data = $_GET['BDdate'];
	$len = strlen($data);
	if ($len >= 5) {
		if ($len > 5) {
			$data = substr($data, 0, 5);
		}
		$birth_string = $data . '.2020';
		$birth_date = date('d.m.Y', strtotime($birth_string));
		date_default_timezone_set('Europe/Kiev');

		$days_ago = date('d.m', strtotime('-2 days', strtotime($birth_date)));

		$current_date = date('d.m', time());

		$result = ($current_date===$days_ago);
		// if ($result) 
		// 	echo "Date ". $days_ago.  " is equal to current ". $current_date ."\n";
		// else
		// 	echo "Dates is not equal";

		
		$json = json_encode([
			'result' => $result,
			'current_date' => date('d.m.Y', time()),
		]);
		if ($json === false) {
		    // Avoid echo of empty string (which is invalid JSON)
		    $json = json_encode(array("jsonError", json_last_error_msg()));
		    if ($json === false) {
		        $json = '{"jsonError": "unknown"}';
		    }
		    // Set HTTP response status code to: 500 - Internal Server Error
		    http_response_code(500);
		}
		echo $json;
	} else {

	}

} else {
    http_response_code(500);
}



?>