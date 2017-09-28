<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

$response = array();

file_put_contents('test_3.txt', file_get_contents('php://input'));

// //Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
	$response["error"] = TRUE;
	$response["error_message"] = "Request method must be POST!";
} else {

	//Receive the RAW post data.
	$content = file_get_contents('php://input');

	//Attempt to decode the incoming RAW post data from JSON.

	$array = json_decode($content, true);	
	 
	// //If json_decode failed, the JSON is invalid.
	if(!is_array($array)) {
		$response["error"] = TRUE;
		$response["error_message"] = "Received content contained invalid JSON!";
		$response["data"] = $array;
	} else {

		$response["error"] = FALSE;

		if(count($array['gps_detail']) > 0) { 
			for($i = 0; $i < count($array['gps_detail']);$i++){
				$date_logged = $array['gps_detail'][$i]['date_logged'];
				$total_distance = $array['gps_detail'][$i]['total_distance'];
				$travel_speed = $array['gps_detail'][$i]['travel_speed'];			

				$db->addGPSDetail($date_logged, $total_distance, $travel_speed);			
			}
		}

		if(count($array['gpx_log_info']) > 0) { 
			for($i = 0; $i < count($array['gpx_log_info']);$i++){
				$log_point = $array['gpx_log_info'][$i]['log_point'];
				$time_record = $array['gpx_log_info'][$i]['time_record'];
				$latitude = $array['gpx_log_info'][$i]['latitude'];
				$longtitude = $array['gpx_log_info'][$i]['longitude'];
				$altitude = $array['gpx_log_info'][$i]['altitude'];
				$accuracy = $array['gpx_log_info'][$i]['accuracy'];
				$date_logged = $array['gpx_log_info'][$i]['date_logged'];
				
				$db->addGPXInfo($log_point, $time_record, $latitude, $longtitude, $altitude, $accuracy, $date_logged);			
			}
		}
	}
}
echo json_encode($response);
?>