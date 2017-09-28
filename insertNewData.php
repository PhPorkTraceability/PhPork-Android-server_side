<?php
header('Content-type:application/json;charset=utf-8');
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

$response = array();

file_put_contents('test.txt', file_get_contents('php://input'));

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
	$response["error"] = TRUE;
	$response["error_message"] = "Request method must be POST!";
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

		if(count($array['pig']) > 0) { 
			for($i = 0; $i < count($array['pig']);$i++){
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
				$pig_batch = $array['pig'][$i]['pig_batch'];

				$db->addPigs($pig_id, $boar_id, $sow_id, $foster_sow, $week_farrowed, $gender, $farrowing_date, $pig_status, $pen_id, $breed_id, $user, $pig_batch);			
			}
		}

		if(count($array['weight_record']) > 0) { 
			for($i = 0; $i < count($array['weight_record']);$i++){
				$record_date = $array['weight_record'][$i]['record_date'];
				$record_time = $array['weight_record'][$i]['record_time'];
				$weight = $array['weight_record'][$i]['weight'];
				$pig_id = $array['weight_record'][$i]['pig_id'];
				$remarks = $array['weight_record'][$i]['remarks'];
				$user = $array['weight_record'][$i]['user'];

				$db->addWeightRecord($record_date, $record_time, $weight, $pig_id, $remarks, $user);
			}
		}

		if(count($array['feed_transaction']) > 0) { 
			for($i = 0; $i < count($array['feed_transaction']);$i++){
				$quantity = $array['feed_transaction'][$i]['quantity'];
				$unit = $array['feed_transaction'][$i]['unit'];
				$date_given = $array['feed_transaction'][$i]['date_given'];
				$time_given = $array['feed_transaction'][$i]['time_given'];
				$pig_id = $array['feed_transaction'][$i]['pig_id'];
				$feed_id = $array['feed_transaction'][$i]['feed_id'];
				$prod_date = $array['feed_transaction'][$i]['prod_date'];

				$db->addFeedsTransact($quantity, $unit, $date_given, $time_given, $pig_id, $feed_id, $prod_date);
			}
		}
		
		if(count($array['med_record']) > 0) { 
			for($i = 0; $i < count($array['med_record']);$i++){
				$date_given = $array['med_record'][$i]['date_given'];
				$time_given = $array['med_record'][$i]['time_given'];
				$quantity = $array['med_record'][$i]['quantity'];
				$unit = $array['med_record'][$i]['unit'];
				$pig_id = $array['med_record'][$i]['pig_id'];
				$med_id = $array['med_record'][$i]['med_id'];

				$db->addMedRecord($date_given, $time_given, $quantity, $unit, $pig_id, $med_id);
			}
		}

		if(count($array['rfid_tags']) > 0) { 
			for($i = 0; $i < count($array['rfid_tags']);$i++){
				$tag_id = $array['rfid_tags'][$i]['tag_id'];
				$tag_rfid = $array['rfid_tags'][$i]['tag_rfid'];
				$pig_id = $array['rfid_tags'][$i]['pig_id'];
				$label = $array['rfid_tags'][$i]['label'];			
				$status = $array['rfid_tags'][$i]['status'];			

				$db->addRFIDTags($tag_id, $tag_rfid, $pig_id, $label, $status);
			}
		}

		if(count($array['user_transaction']) > 0) { 
			for($i = 0; $i < count($array['user_transaction']);$i++){
				$user_id = $array['user_transaction'][$i]['user_id'];
				$date_edited = $array['user_transaction'][$i]['date_edited'];
				$id_edited = $array['user_transaction'][$i]['id_edited'];
				$type_edited = $array['user_transaction'][$i]['type_edited'];
				$prev_value = $array['user_transaction'][$i]['prev_value'];
				$curr_value = $array['user_transaction'][$i]['curr_value'];
				$pig_id = $array['user_transaction'][$i]['pig_id'];
				$flag = $array['user_transaction'][$i]['flag'];

				$db->addUserTransactions($user_id, $date_edited, $id_edited, $type_edited, $prev_value, $curr_value, $pig_id, $flag);
			}
		}
	}
} 

echo json_encode($response);

?>