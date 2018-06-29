<?php

   include_once 'dataManager.php';

   $manager = new DataManager;

if($_SERVER['REQUEST_METHOD'] == "POST"){

// list fields
    
    $questionID = $_POST['questionID'];
  
       if(!empty($questionID)){
       //set up query
       	$query = 'select a_id, a_text, p_filename from multanswers natural join answers where q_id =' . $questionID . ';';
        //$values = array($memberFirstName, $memberLastName);
           
		$manager->connect();
             
		$result = $manager->doQuery($query);
		
         if($result){
             // process the results placing them in an array
		$resultArray = array();
        while($row = $result->fetch()) {
            extract($row);
            $resultArray[] = array("a_id" => $a_id, "a_text" => $a_text, "p_filename" => $p_filename);
		} 
             // disconnect
		$manager->disconnect();
             
        $json = array("question_answers" => $resultArray);
            }
        else {$json = array("status" => 0, "msg" => "Not result");}
       }
       else{
           $json = array("status" => 0, "msg" => "Input not defined");
       }
}

       else{ // method not POST
        $json = array("status" => 0, "msg" => "Request method not accepted");
        }
    
    /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
    
    ?>