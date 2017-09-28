<?php
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }

    /*
        Methods for adding data fetched from the client apps to the current database
    */
    public function addUsers($user_name, $password, $user_type) {
        $stmt = $this->conn->prepare("INSERT INTO user(user_name, password, user_type, sync_status) VALUES(?,?,?,'new')");
 
        $stmt->bind_param("sss", $user_name, $password, $user_type);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addLocations($loc_name, $address) {
        $stmt = $this->conn->prepare("INSERT INTO location(loc_name, address, sync_status) VALUES(?,?,'new')");
 
        $stmt->bind_param("ss", $loc_name, $address);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addHouses($house_no, $house_name, $function, $loc_id) {
        $stmt = $this->conn->prepare("INSERT INTO house(house_no, house_name, function, loc_id, sync_status) VALUES(?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssss", $house_no, $house_name, $function, $loc_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPens($pen_no, $function, $house_id) {
        $stmt = $this->conn->prepare("INSERT INTO pen(pen_no, function, house_id, sync_status) VALUES(?,?,?,'new')");
 
        $stmt->bind_param("sss", $pen_no, $function, $house_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addBreeds($breed_name) {
        $stmt = $this->conn->prepare("INSERT INTO pig_breeds(breed_name, sync_status) VALUES(?,'new')");
 
        $stmt->bind_param("s", $breed_name);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addParents($label, $label_id) {
        $stmt = $this->conn->prepare("INSERT INTO parents(label, label_id, sync_status) VALUES(?,?,'new')");
 
        $stmt->bind_param("ss", $label, $label_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addFeeds($feed_name, $feed_type) {
        $stmt = $this->conn->prepare("INSERT INTO feeds(feed_name, feed_type, sync_status) VALUES(?,?,'new')");
 
        $stmt->bind_param("ss", $feed_name, $feed_type);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addMeds($med_name, $med_type) {
        $stmt = $this->conn->prepare("INSERT INTO medication(med_name, med_type, sync_status) VALUES(?,?,'new')");
 
        $stmt->bind_param("ss", $med_name, $med_type);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addRFIDTags($tag_id, $tag_rfid, $pig_id, $label, $status) {
        $stmt = $this->conn->prepare("INSERT INTO rfid_tags(tag_id, tag_rfid, pig_id, label, status, sync_status) VALUES(?,?,?,?,?,'new')");
 
        $stmt->bind_param("sssss", $tag_id, $tag_rfid, $pig_id, $label, $status);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addUserTransactions($user_id, $date_edited, $id_edited, $type_edited, $prev_value, $curr_value, $pig_id, $flag) {
        $stmt = $this->conn->prepare("INSERT INTO user_transaction(user_id, date_edited, id_edited, type_edited,
                                            prev_value, curr_value, pig_id, flag, sync_status) VALUES(?,?,?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssssssss", $user_id, $date_edited, $id_edited, $type_edited, $prev_value, $curr_value, $pig_id, $flag);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addMovements($date_moved, $time_moved, $pen_id, $server_date, $server_time, $pig_id) {
        $stmt = $this->conn->prepare("INSERT INTO movement(date_moved, time_moved, pen_id, server_date, server_time, pig_id, sync_status) 
                                        VALUES(?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssssss", $date_moved, $time_moved, $pen_id, $server_date, $server_time, $pig_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPigs($pig_id, $boar_id, $sow_id, $foster_sow, $week_farrowed, $gender, $farrowing_date, $pig_status, $pen_id, $breed_id, $user, $pig_batch)
    {
        $stmt = $this->conn->prepare("INSERT INTO pig(pig_id, boar_id, sow_id, foster_sow, week_farrowed, gender, farrowing_date, pig_status, pen_id, breed_id, user, pig_batch, sync_status)
                                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssssssssssss", $pig_id, $boar_id, $sow_id, $foster_sow, $week_farrowed, $gender, $farrowing_date, $pig_status, $pen_id, $breed_id, $user, $pig_batch);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addWeightRecord($record_date, $record_time, $weight, $pig_id, $remarks, $user)
    {
        $stmt = $this->conn->prepare("INSERT INTO weight_record(record_date, record_time, weight, pig_id, remarks, user, sync_status) VALUES(?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssssss", $record_date, $record_time, $weight, $pig_id, $remarks, $user);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addFeedsTransact($quantity, $unit, $date_given, $time_given, $pig_id, $feed_id, $prod_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO feed_transaction(quantity, unit, date_given, time_given, pig_id, feed_id, prod_date, sync_status) VALUES(?,?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("sssssss", $quantity, $unit, $date_given, $time_given, $pig_id, $feed_id, $prod_date);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addMedRecord($date_given, $time_given, $quantity, $unit, $pig_id, $med_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO med_record(date_given, time_given, quantity, unit, pig_id, med_id, sync_status) VALUES(?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("ssssss", $date_given, $time_given, $quantity, $unit, $pig_id, $med_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addGPSDetail($date_logged, $total_distance, $travel_speed)
    {
        $stmt = $this->conn->prepare("INSERT INTO gps_detail(date_logged, total_distance, travel_speed, sync_status) VALUES(?,?,?,'new')");
 
        $stmt->bind_param("sss", $date_logged, $total_distance, $travel_speed);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

  public function addGPXInfo($log_point, $time_record, $latitude, $longtitude, $altitude, $accuracy, $date_logged)
    {
        $stmt = $this->conn->prepare("INSERT INTO gpx_log_info(log_point, time_record, latitude, longtitude, altitude, accuracy, date_logged, sync_status) VALUES(?,?,?,?,?,?,?,'new')");
 
        $stmt->bind_param("sssssss", $log_point, $time_record, $latitude, $longtitude, $altitude, $accuracy, $date_logged);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    /*
        Methods for updating data sent to old
    */
    public function assignTagToPig($pig_id, $tag_id)
    {
        $stmt = $this->conn->prepare("UPDATE rfid_tags SET pig_id = ?, status = 'active' WHERE tag_id = ?");
 
        $stmt->bind_param("ss", $pig_id, $tag_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function updateUserSync($id) {
        $stmt = $this->conn->prepare("UPDATE user SET sync_status = 'old' WHERE user_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

    public function updateLocSync($id) {
        $stmt = $this->conn->prepare("UPDATE location SET sync_status = 'old' WHERE loc_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateHouseSync($id) {
        $stmt = $this->conn->prepare("UPDATE house SET sync_status = 'old' WHERE house_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updatePenSync($id) {
        $stmt = $this->conn->prepare("UPDATE pen SET sync_status = 'old' WHERE pen_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateBreedSync($id) {
        $stmt = $this->conn->prepare("UPDATE pig_breeds SET sync_status = 'old' WHERE breed_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateParentSync($id) {
        $stmt = $this->conn->prepare("UPDATE parents SET sync_status = 'old' WHERE parent_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updatePigSync($id) {
        $stmt = $this->conn->prepare("UPDATE pig SET sync_status = 'old' WHERE pig_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateTagSync($id) {
        $stmt = $this->conn->prepare("UPDATE rfid_tags SET sync_status = 'old' WHERE tag_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateFeedSync($id) {
        $stmt = $this->conn->prepare("UPDATE feeds SET sync_status = 'old' WHERE feed_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateFTSync($id) {
        $stmt = $this->conn->prepare("UPDATE feed_transaction SET sync_status = 'old' WHERE ft_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateMedSync($id) {
        $stmt = $this->conn->prepare("UPDATE medication SET sync_status = 'old' WHERE med_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateMedRecSync($id) {
        $stmt = $this->conn->prepare("UPDATE med_record SET sync_status = 'old' WHERE mr_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateWeightSync($id) {
        $stmt = $this->conn->prepare("UPDATE weight_record SET sync_status = 'old' WHERE record_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateMovementSync($id) {
        $stmt = $this->conn->prepare("UPDATE movement SET sync_status = 'old' WHERE movement_id = ?");

        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

     public function updateUserTransSync($id) {
        $stmt = $this->conn->prepare("UPDATE user_transaction SET sync_status = 'old' WHERE trans_id = ?");
 
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;        
    }

    /*
        Methods for getting data to be fetched by Android client
        Used in: getTablesData.php, getSlaughterData.php
    */

    public function getUsers() {
 
        $stmt = $this->conn->prepare("SELECT * FROM user");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    
    public function getLocs() {
 
        $stmt = $this->conn->prepare("SELECT * FROM location");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getHouses() {
 
        $stmt = $this->conn->prepare("SELECT * FROM house");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getPens() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pen");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getBreeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pig_breeds");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getParents() {
 
        $stmt = $this->conn->prepare("SELECT * FROM parents");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getPigs() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pig WHERE pig_status <> 'mortality' AND pig_status <> 'slaughter' AND pig_status <> 'condemn'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getWeightRecords() {
 
        $stmt = $this->conn->prepare("SELECT * FROM weight_record a JOIN pig b ON(a.pig_id = b.pig_id) WHERE b.pig_status <> 'mortality' AND pig_status <> 'slaughter' AND pig_status <> 'condemn'");
        
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getTags() {
 
        $stmt = $this->conn->prepare("SELECT a.tag_id, a.tag_rfid, a.pig_id, a.label, a.status
                                        FROM rfid_tags a JOIN pig b USING(pig_id)                            
                                        WHERE a.status <> 'lost' AND status <> 'inactive' AND status <> 'marker'
                                        AND b.pig_status <> 'mortality' AND pig_status <> 'slaughter' AND pig_status <> 'condemn'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getFeeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM feeds");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getLatestFT() {
 
        $stmt = $this->conn->prepare("SELECT a.ft_id, a.quantity, a.unit, MAX(a.date_given), MAX(a.time_given), a.pig_id, a.feed_id, a.prod_date
                                        FROM feed_transaction a JOIN pig b USING(pig_id)
                                        WHERE b.pig_status <> 'mortality' AND pig_status <> 'slaughter' AND pig_status <> 'condemn'
                                        GROUP BY a.pig_id");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getMeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM medication");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getLatestMedRecords() {
 
        $stmt = $this->conn->prepare("SELECT a.mr_id, MAX(a.date_given), MAX(a.time_given), a.quantity, a.unit, a.pig_id, a.med_id
                                        FROM med_record a JOIN pig b USING(pig_id)
                                        WHERE b.pig_status <> 'mortality' AND pig_status <> 'slaughter' AND pig_status <> 'condemn'
                                        GROUP BY a.pig_id");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getLastPigID(){
        $stmt = $this->conn->prepare("SELECT MAX(pig_id) FROM pig");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getMovement() {

        $stmt = $this->conn->prepare("SELECT movement_id, MAX(date_moved), MAX(time_moved), pen_id, MAX(server_date), MAX(server_time), pig_id
                                        FROM movement
                                        WHERE sync_status = 'new'
                                        GROUP BY pig_id");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    /*
        Methods for getting data to be sent to server
        Used in data_sender.php
    */

    public function getNewMovements() {

        $stmt = $this->conn->prepare("SELECT * FROM movement WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewWeightRecords() {
        $stmt = $this->conn->prepare("SELECT * FROM weight_record WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewUsers() {
 
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    
    public function getNewLocs() {
 
        $stmt = $this->conn->prepare("SELECT * FROM location WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewHouses() {
 
        $stmt = $this->conn->prepare("SELECT * FROM house WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewPens() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pen WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getNewBreeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pig_breeds WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewParents() {
 
        $stmt = $this->conn->prepare("SELECT * FROM parents WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewPigs() {
 
        $stmt = $this->conn->prepare("SELECT * FROM pig WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewTags() {
 
        $stmt = $this->conn->prepare("SELECT * FROM rfid_tags WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewFeeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM feeds WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getNewFT() {
 
        $stmt = $this->conn->prepare("SELECT * FROM feed_transaction WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }


    public function getNewMeds() {
 
        $stmt = $this->conn->prepare("SELECT * FROM medication WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewMedRecords() {
 
        $stmt = $this->conn->prepare("SELECT * FROM med_record WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

    public function getNewUserTransaction() {
 
        $stmt = $this->conn->prepare("SELECT * FROM user_transaction WHERE sync_status = 'new'");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all();
            return $result;
        } else {
            return NULL;
        }
    }

}
?>