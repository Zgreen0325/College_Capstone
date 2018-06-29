 <?php

function createDeviceID($nickname, $manager)
{       
        
        if (!empty($nickname)) {
            // set up a prepared statement to modify database
            
            $query = "INSERT INTO nicknames (nickname)";
            $query .= "values(?);";
            $values = array(
                $nickname
            );
            
            // connect to the database and execute the query.    
            $manager->connect();
            $result = $manager->doNonQuery($query, TRUE, $values);
            
            // disconnect
            $manager->disconnect();
            
            if (!$result) {
                $json = array(
                    "status" => 0,
                    "msg" => "Error Posting to Database"
                );
            }
        } else {
            $json = array(
                "status" => 0,
                "msg" => "Input not defined"
            );
        }

    if (!empty($nickname)) {
        //set up query
        $query = 'select max(device_id) as device_id from nicknames where nickname = "' . $nickname . '";';
        //$values = array($memberFirstName, $memberLastName);
        
        $manager->connect();
        
        $result = $manager->doQuery($query);
        
        if ($result) {
            // process the results placing them in an array
            $resultArray = array();
            while ($row = $result->fetch()) {
                extract($row);
                $resultArray[] = array(
                    "device_id" => $device_id
                );
            }
            // disconnect
            $manager->disconnect();
            
            $json = array(
                "deviceID" => $resultArray
            );
        } else {
            $json = array(
                "status" => 0,
                "msg" => "Not result"
            );
        }
    } else {
        $json = array(
            "status" => 0,
            "msg" => "Input not defined"
        );
    }
    return $device_id;
}

?> 