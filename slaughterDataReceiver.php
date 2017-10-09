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
	
	// Make sure that the content type of the POST request has been set to application/json
	// $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	// if(strcasecmp($contentType, 'application/json') != 0) {
	// 	$response["error"] = TRUE;
	// 	$response["error_message"] = "Content type must be: application/json";
	// } else {
		
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

			if(count($array['pig']) > 0) {
				for($i = 0; $i < count($array['pig']);$i++) {
					$pig_id = $array['pig'][$i]['pig_id'];
					$pig_status = $array['pig'][$i]['pig_status'];	
					$user = $array['pig'][$i]['user'];

					$db->updatePigSlaughter($pig_id, $pig_status, $user);
				}
			}
		
			if(count($array['slaughter_pig']) > 0) {
				for($i = 0; $i < count($array['slaughter_pig']);$i++) {
					$sl_stat = $array['slaughter_pig'][$i]['slaughter_stat'];
					$sl_timestamp = $array['slaughter_pig'][$i]['slaughter_timestamp'];
					$pig_id = $array['slaughter_pig'][$i]['pig_id'];

					$db->addSlaughterPig($sl_stat, $sl_timestamp, $pig_id);
				}
			}	
		}
	// }	 
}
 
echo json_encode($response);
?>
