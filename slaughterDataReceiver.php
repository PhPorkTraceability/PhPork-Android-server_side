<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require_once 'include/DB_Functions.php';

$db = new DB_Functions();

$response = array();

// check test data
file_put_contents('test_2.txt', file_get_contents('php://input'));

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
	$response["error"] = TRUE;
	$response["error_message"] = "Request method must be POST!";
} else {
	
	//Make sure that the content type of the POST request has been set to application/json
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	if(strcasecmp($contentType, 'application/json') != 0) {
		$response["error"] = TRUE;
		$response["error_message"] = "Content type must be: application/json";
	} else {
		
		//Receive the RAW post data.

		$content = file_get_contents("php://input");

		//Attempt to decode the incoming RAW post data from JSON.
		$array = json_decode($content, true);
		 
		//If json_decode failed, the JSON is invalid.
		if(!is_array($array)) {
			$response["error"] = TRUE;
			$response["error_message"] = "Received content contained invalid JSON!";
		} else {

			$response["error"] = FALSE;				

			for($i = 0; $i < count($array['pig']);$i++) {
				$pig_id = $array['pig'][$i]['pig_id'];
				$boar_id = $array['pig'][$i]['boar_id'];
				$sow_id = $array['pig'][$i]['sow_id'];
				$foster_sow = $array['pig'][$i]['foster_sow'];
				$week_farrowed = $array['pig'][$i]['week_farrowed'];
				$gender = $array['pig'][$i]['gender'];
				$farrowing_date = $array['pig'][$i]['farrowing_date'];
				$pig_status = $array['pig'][$i]['pig_status'];
				$pen_id = $array['pig'][$i]['pen_id'];
				$breed_id = $array['pig'][$i]['breed_id'];
				$user = $array['pig'][$i]['user'];

				$db->addPigs($pig_id, $boar_id, $sow_id, $foster_sow, $week_farrowed, $gender,
					$farrowing_date, $pig_status, $pen_id, $breed_id, $user);
			}
		
			for($i = 0; $i < count($array['movement']);$i++) {
				$date_moved = $array['movement'][$i]['date_moved'];
				$time_moved = $array['movement'][$i]['time_moved'];
				$pen_id = $array['movement'][$i]['pen_id'];
				$server_date = $array['movement'][$i]['server_date'];
				$server_time = $array['movement'][$i]['server_time'];
				$pig_id = $array['movement'][$i]['pig_id'];

				$db->addMovements($date_moved, $time_moved, $pen_id, $server_date, $server_time, $pig_id);
			}
		}
	}	 
}
 
echo json_encode($response);
?>
