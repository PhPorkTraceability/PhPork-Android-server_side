<?php

require_once 'include/DB_Functions.php';
header('Content-Type: application/json');
$db = new DB_Functions();
 
// json response array
$response = array();

// get data from required tables
$users = $db->getUsers();
$locs = $db->getLocs();
$houses = $db->getHouses();
$pens = $db->getPens();
$breeds = $db->getBreeds();
$parents = $db->getParents();
$pigs = $db->getPigs();
$weight_record = $db->getWeightRecords();
$tags = $db->getTags();
$feeds = $db->getFeeds();
$feed_transaction = $db->getLatestFT();
$meds = $db->getMeds();
$med_records = $db->getLatestMedRecords();
$last_id = $db->getLastPigID();

$u_size = count($users);
$last = count($last_id);
$l_size = count($locs);
$h_size = count($houses);
$p_size = count($pens);
$br_size = count($breeds);
$pa_size = count($parents);
$pg_size = count($pigs);
$wr_size = count($weight_record);
$t_size = count($tags);
$f_size = count($feeds);
$ft_size = count($feed_transaction);
$m_size = count($meds);
$mr_size = count($med_records);

$response["error"] = FALSE;
$response["user"] = array();
$response["last_id"] = array();
$response["location"] = array();
$response["house"] = array();
$response["pen"] = array();
$response["pig_breeds"] = array();
$response["parents"] = array();
$response["pig"] = array();
$response["weight_record"] = array();
$response["rfid_tags"] = array();
$response["feeds"] = array();
$response["feed_transaction"] = array();
$response["medication"] = array();
$response["med_record"] = array();

for($i = 0;$i < $last;$i++)
{
	$resp = array();
	$resp["pig_id"] = $last_id[$i][0];

	array_push($response["last_id"], $resp);
}

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

if(count($l_size > 0)) {
	for($i = 0;$i < $l_size;$i++) {
		$resp = array();
		$resp["loc_id"] = $locs[$i][0];
		$resp["loc_name"] = $locs[$i][1];
		$resp["address"] = $locs[$i][2];

		array_push($response["location"], $resp);
	}
}

if(count($h_size > 0)) {
	for($i = 0;$i < $h_size;$i++)
	{
		$resp = array();
		$resp["house_id"] = $houses[$i][0];
		$resp["house_no"] = $houses[$i][1];
		$resp["house_name"] = $houses[$i][2];
		$resp["function"] = $houses[$i][3];
		$resp["loc_id"] = $houses[$i][4];
	
		array_push($response["house"], $resp);
	}
}

if(count($p_size > 0)) {
	for($i = 0;$i < $p_size;$i++)
	{
		$resp = array();
		$resp["pen_id"] = $pens[$i][0];
		$resp["pen_no"] = $pens[$i][1];
		$resp["function"] = $pens[$i][2];
		$resp["house_id"] = $pens[$i][3];
	
		array_push($response["pen"], $resp);
	}
}

if(count($br_size > 0)) {
	for($i = 0;$i < $br_size;$i++)
	{
		$resp = array();
		$resp["breed_id"] = $breeds[$i][0];
		$resp["breed_name"] = $breeds[$i][1];
	
		array_push($response["pig_breeds"], $resp);
	}
}

if(count($pa_size > 0)) {
	for($i = 0;$i < $pa_size;$i++)
	{
		$resp = array();
		$resp["parent_id"] = $parents[$i][0];
		$resp["label"] = $parents[$i][1];
		$resp["label_id"] = $parents[$i][2];
	
		array_push($response["parents"], $resp);
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

if(count($wr_size > 0)) {
	for($i = 0;$i < $wr_size;$i++)
	{
		$resp = array();
		$resp["record_id"] = $weight_record[$i][0];
		$resp["record_date"] = $weight_record[$i][1];
		$resp["record_time"] = $weight_record[$i][2];
		$resp["weight"] = $weight_record[$i][3];
		$resp["pig_id"] = $weight_record[$i][4];
		$resp["remarks"] = $weight_record[$i][5];
		$resp["user"] = $weight_record[$i][6];

		array_push($response["weight_record"], $resp);
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

if(count($f_size > 0)) {
	for($i = 0;$i < $f_size;$i++)
	{
		$resp = array();
		$resp["feed_id"] = $feeds[$i][0];
		$resp["feed_name"] = $feeds[$i][1];
		$resp["feed_type"] = $feeds[$i][2];		

		array_push($response["feeds"], $resp);
	}
}

if(count($ft_size > 0)) {
	for($i = 0;$i < $ft_size;$i++)
	{
		$resp = array();
		$resp["ft_id"] = $feed_transaction[$i][0];
		$resp["quantity"] = $feed_transaction[$i][1];
		$resp["unit"] = $feed_transaction[$i][2];
		$resp["date_given"] = $feed_transaction[$i][3];
		$resp["time_given"] = $feed_transaction[$i][4];
		$resp["pig_id"] = $feed_transaction[$i][5];
		$resp["feed_id"] = $feed_transaction[$i][6];
		$resp["prod_date"] = $feed_transaction[$i][7];

		array_push($response["feed_transaction"], $resp);
	}
}

if(count($m_size > 0)) {
	for($i = 0;$i < $m_size;$i++)
	{
		$resp = array();
		$resp["med_id"] = $meds[$i][0];
		$resp["med_name"] = $meds[$i][1];
		$resp["med_type"] = $meds[$i][2];

		array_push($response["medication"], $resp);
	}
}

if(count($mr_size > 0)) {
	for($i = 0;$i < $mr_size;$i++)
	{
		$resp = array();
		$resp["mr_id"] = $med_records[$i][0];
		$resp["date_given"] = $med_records[$i][1];
		$resp["time_given"] = $med_records[$i][2];
		$resp["quantity"] = $med_records[$i][3];
		$resp["unit"] = $med_records[$i][4];
		$resp["pig_id"] = $med_records[$i][5];
		$resp["med_id"] = $med_records[$i][6];
		
		array_push($response["med_record"], $resp);
	}
}

echo json_encode($response);

?>