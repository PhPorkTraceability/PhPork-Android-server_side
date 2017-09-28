<?php

require_once 'include/DB_Functions.php';
header('Content-Type: application/json');
$db = new DB_Functions();
 
// json response array
$response = array();

// get data from required tables
$users = $db->getUsers();
$pigs = $db->getPigs();
$tags = $db->getTags();
$movement = $db->getMovement();

$u_size = count($users);
$pg_size = count($pigs);
$t_size = count($tags);
$mv_size = count($movement);

$response["error"] = FALSE;
$response["user"] = array();
$response["pig"] = array();
$response["rfid_tags"] = array();
$response["movement"] = array();

if(count($u_size > 0)) {
	for($i = 0;$i < $u_size;$i++)
	{
		$resp = array();
		$resp["user_name"] = $users[$i][1];
		$resp["password"] = $users[$i][2];
		$resp["user_type"] = $users[$i][3];

		array_push($response["user"], $resp);
	}
}

if(count($pg_size > 0)) {
	for($i = 0;$i < $pg_size;$i++)
	{
		$resp = array();
		$resp["pig_id"] = $pigs[$i][0];
		$resp["boar_id"] = $pigs[$i][1];
		$resp["sow_id"] = $pigs[$i][2];
		$resp["foster_sow"] = $pigs[$i][3];
		$resp["week_farrowed"] = $pigs[$i][4];
		$resp["gender"] = $pigs[$i][5];
		$resp["farrowing_date"] = $pigs[$i][6];
		$resp["pig_status"] = $pigs[$i][7];
		$resp["pen_id"] = $pigs[$i][8];
		$resp["breed_id"] = $pigs[$i][9];
		$resp["user"] = $pigs[$i][10];
		$resp["pig_batch"] = $pigs[$i][11];

		array_push($response["pig"], $resp);
	}
}

if(count($t_size > 0)) {
	for($i = 0;$i < $t_size;$i++)
	{
		$resp = array();
		$resp["tag_id"] = $tags[$i][0];
		$resp["tag_rfid"] = $tags[$i][1];
		$resp["pig_id"] = $tags[$i][2];
		$resp["label"] = $tags[$i][3];
		$resp["status"] = $tags[$i][4];

		array_push($response["rfid_tags"], $resp);
	}
}

if(count($mv_size > 0)) {
	for($i = 0;$i < $mv_size;$i++)
	{
		$resp = array();
		$resp["movement_id"] = $movement[$i][0];
		$resp["date_moved"] = $movement[$i][1];
		$resp["time_moved"] = $movement[$i][2];
		$resp["pen_id"] = $movement[$i][3];
		$resp["server_date"] = $movement[$i][4];
		$resp["server_time"] = $movement[$i][5];
		$resp["pig_id"] = $movement[$i][6];
		
		array_push($response["movement"], $resp);
	}
}

echo json_encode($response);

?>