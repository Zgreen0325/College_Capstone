<?php

    function setQuestion($manager, $qID, $deviceID) {
        $success = checkExists($manager, $deviceID);
        $manager->connect();
        
        if ($success == "yes") {
            $query = "UPDATE currentquestion SET q_id=".$qID." WHERE m_device_id = ".$deviceID.";";
        } else if ($success == "no") {
            $query = "INSERT INTO currentquestion VALUES(".$deviceID.", ".$qID.");";
        }
	
        $result = $manager->doNonQuery($query,true,null);

        $manager->disconnect();

        return "success";
    }

    function checkExists($manager, $deviceID) {
        $manager->connect();
        $query = "SELECT * FROM currentquestion WHERE m_device_id = ".$deviceID.";";
        
        $result = $manager->doQuery($query);
        
        if($result->rowCount() > 0) {
            $success = "yes";
        } else {
            $success = "no";
        }
        
        $manager->disconnect();

        return $success;
    }
?>